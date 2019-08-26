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
                <h3 class="box-title">Edit</h3>
              </div>

              <div class="box-body" v-if="!loading">
                <!-- <back-buttton></back-buttton> -->
                <router-link
                  v-if="$can('key_answer_access')"
                  :to="{ name: 'key.answers.index', params: { id: item.filter_key_id}}"
                  class="btn btn-default btn-sm"
                >
                  <span class="glyphicon glyphicon-chevron-left"></span> Back to all
                </router-link>
              </div>

              <bootstrap-alert />

              <div class="box-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="sel1">Select Language:</label>
                    <select
                      class="form-control"
                      name="locale"
                      required
                      :value="locale"
                      @input="updateLocale"
                    >
                      <option
                        v-for="language in languages"
                        v-bind:key="language.id"
                        :value="language.locale"
                      >{{language.language}}</option>
                    </select>
                  </div>
                </div>
                <div class="row" v-if="loading">
                  <div class="col-xs-4 col-xs-offset-4">
                    <div class="alert text-center">
                      <i class="fa fa-spin fa-refresh"></i> Loading
                    </div>
                  </div>
                </div>
                <div class v-if="!loading">
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
    };
  },
  computed: {
    ...mapGetters("KeyAnswersSingle", [
      "item",
      "loading",
      "languages",
      "locale"
    ])
  },
  created() {
    this.init();
  },
  destroyed() {
    this.resetState();
  },
  watch: {
    "$route.params.id": function() {
      this.init();
    }
  },
  methods: {
    ...mapActions("KeyAnswersSingle", [
      "fetchData",
      "fetchLanguageData",
      "updateData",
      "resetState",
      "setTitle",
      "setFilterKeyId",
      "setLocale"
    ]),
    init() {
      this.resetState();
      this.fetchData(this.$route.params.id)
        .then(() => {})
        .catch(error => {
          console.error(error);
        });
      this.fetchLanguageData();
    },
    updateLocale(e) {
      this.setLocale(e.target.value);
      this.fetchData(this.$route.params.id);
    },
    updateTitle(e) {
      this.setTitle(e.target.value);
    },
    submitForm() {
      this.updateData()
        .then(() => {
          // this.$router.push({
          //   name: "factors.index",
          //   params: {
          //     id: this.item.test_id
          //   }
          // });
          this.$eventHub.$emit("update-success");
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
