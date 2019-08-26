<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>City</h1>
    </section>

    <section class="content">
      <div class="panel panel-success" v-if="!loading">
        <div class="panel-heading">Coutry</div>
        <div class="panel-body">
          <country-flag :country="countryCode" size="big" class="flag-icon" />
        </div>
      </div>
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

              <bootstrap-alert />

              <div class="box-body">
                <div class="form-group">
                  <label for="title">City Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Enter Name *"
                    :value="item.name"
                    @input="updateCityName"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="title">Postal Code</label>
                  <input
                    type="text"
                    class="form-control"
                    name="code"
                    placeholder="Enter Postal Code *"
                    :value="item.postal_code"
                    @input="updatePostalCode"
                    required
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
      countryId: this.$route.params.id,
      countryCode: this.$route.params.code
    };
  },

  computed: {
    ...mapGetters("CitiesSingle", ["item", "loading"])
  },
  watch: {
    "$route.params.id": function() {
      this.init();
    }
  },
  created() {
    // Code ...
    this.init();
  },
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("CitiesSingle", [
      "storeData",
      "resetState",
      "setName",
      "setPostalCode",
      "setCountryId"
    ]),
    init() {
      this.setCountryId(this.$route.params.id);
    },
    updateCityName(e) {
      this.setName(e.target.value);
    },
    updatePostalCode(e) {
      this.setPostalCode(e.target.value);
    },

    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({
            name: "cities.index",
            params: {
              id: this.countryId
            }
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
