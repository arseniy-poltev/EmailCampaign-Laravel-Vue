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
                <h3 class="box-title">Create</h3>
              </div>

              <div class="box-body">
                <back-buttton></back-buttton>
              </div>

              <bootstrap-alert/>

              <div class="box-body">
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
    // Code ...
  },
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("CurrenciesSingle", [
      "storeData",
      "resetState",
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
      this.storeData()
        .then(() => {
          this.$router.push({
            name: "currencies.index"
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
