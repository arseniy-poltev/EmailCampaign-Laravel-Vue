<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>City</h1>
    </section>

    <section class="content">
      <div class="panel panel-success" v-if="!loading">
        <div class="panel-heading">Coutry</div>
        <div class="panel-body">
          <h2>{{item.country_name}}</h2>
          <country-flag :country="item.country_code" size="big" class="flag-icon" />
        </div>
      </div>
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
      countryId: this.$route.params.id
    };
  },
  computed: {
    ...mapGetters("CitiesSingle", ["item", "loading"])
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
    ...mapActions("CitiesSingle", [
      "resetState",
      "fetchData",
      "updateData",
      "setName",
      "setPostalCode"
    ]),
    updateCityName(e) {
      this.setName(e.target.value);
    },
    updatePostalCode(e) {
      this.setPostalCode(e.target.value);
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({
            name: "cities.index",
            params: {
              id: this.item.country_id
            }
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
