<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Campaign</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <form @submit.prevent="submitForm">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
              </div>

              <div class="box-body">
                <back-buttton></back-buttton>
              </div>

              <bootstrap-alert/>
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i> Loading
                  </div>
                </div>
              </div>
              <div class="box-body" v-if="!loading">
                <div class="form-group">
                  <label for="title">Campaign Name*</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Enter Campaign Name*"
                    :value="item.name"
                    @input="updateName"
                    required
                  >
                </div>
                <div class="form-group">
                  <label for="title">SMS Sender *</label>
                  <input
                    type="text"
                    class="form-control"
                    name="sender_name"
                    placeholder="Enter SMS Sender name *"
                    :value="item.sender_name"
                    @input="updateSenderName"
                    required
                  >
                </div>
                <div class="form-group">
                  <label for="description">SMS Message *</label>
                  <textarea
                    rows="6"
                    class="form-control"
                    name="message"
                    placeholder="Enter SMS Message"
                    :value="item.message"
                    @input="updateMessage"
                  ></textarea>
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
    };
  },
  computed: {
    ...mapGetters("CampaignsSingle", ["item", "loading"])
  },
  created() {
    this.fetchData(this.$route.params.id);
  },
  destroyed() {
    this.resetState();
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("CampaignsSingle", [
      "resetState",
      "fetchData",
      "updateData",
      "setName",
      "setSenderName",
      "setMessage"
    ]),
    updateName(e) {
      this.setName(e.target.value);
    },
    updateSenderName(e) {
      this.setSenderName(e.target.value);
    },
    updateMessage(e) {
      this.setMessage(e.target.value);
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({
            name: "campaigns.index"
          });
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
