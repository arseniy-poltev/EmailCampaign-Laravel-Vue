<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Key Answer</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <form @submit.prevent="submitForm">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Create</h3>
              </div>

              <div class="box-body">
                <!-- <back-buttton></back-buttton> -->
                <router-link
                  v-if="$can('key_answer_access')"
                  :to="{ name: 'key.answers.index', params: { id: filterKeyId}}"
                  class="btn btn-default btn-sm"
                >
                  <span class="glyphicon glyphicon-chevron-left"></span> Back to all
                </router-link>
              </div>

              <bootstrap-alert />
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i> Loading
                  </div>
                </div>
              </div>
              <div class="box-body" v-if="!loading">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input
                    type="text"
                    class="form-control"
                    name="title"
                    placeholder="Enter Title *"
                    :value="item.title"
                    @input="updateTitle"
                  />
                </div>
              </div>

              <div class="box-footer">
                <vue-button-spinner
                  class="btn btn-primary btn-sm"
                  :isLoading="loading"
                  :disabled="loading"
                >Save</vue-button-spinner>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      // Code...

      filterKeyId: this.$route.params.id
    };
  },
  created() {
    // Code ...
    this.init();
  },
  computed: {
    ...mapGetters("KeyAnswersSingle", ["item", "loading"])
  },
  watch: {
    "$route.params.id": function() {
      this.init();
    }
  },
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("KeyAnswersSingle", [
      "storeData",
      "resetState",
      "setTitle",
      "setFilterKeyId"
    ]),
    init() {
      this.resetState();
      this.setFilterKeyId(this.$route.params.id);
    },

    updateTitle(e) {
      this.setTitle(e.target.value);
    },
    submitForm() {
      this.storeData()
        .then(result => {
          this.$router.push({
            name: "key.answers.index",
            params: { id: this.filterKeyId }
          });

          this.$eventHub.$emit("create-success");
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>

<style scoped>
</style>
