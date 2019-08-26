<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Currency</h1>
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
                  <label for="title">Currency Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Enter Currency Name *"
                    :value="item.name"
                    @input="updateCurrencyName"
                    required
                  >
                </div>
                <div class="form-group">
                  <label for="title">Currency Code</label>
                  <input
                    type="text"
                    class="form-control"
                    name="code"
                    placeholder="Enter Currency Code *"
                    :value="item.code"
                    @input="updateCurrencyCode"
                    required
                  >
                </div>
                <div class="form-group">
                  <label for="title">Currency Symbol</label>
                  <input
                    type="text"
                    class="form-control"
                    name="symbol"
                    placeholder="Enter Currency Symbol *"
                    :value="item.symbol"
                    @input="updateCurrencySymbol"
                    required
                  >
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
    ...mapGetters("CurrenciesSingle", ["item", "loading"])
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
    ...mapActions("CurrenciesSingle", [
      "resetState",
      "fetchData",
      "updateData",
      "setName",
      "setCode",
      "setSymbol"
    ]),
    updateCurrencyName(e) {
      this.setName(e.target.value);
    },
    updateCurrencyCode(e) {
      this.setCode(e.target.value);
    },
    updateCurrencySymbol(e) {
      this.setSymbol(e.target.value);
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({
            name: "currencies.index"
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
