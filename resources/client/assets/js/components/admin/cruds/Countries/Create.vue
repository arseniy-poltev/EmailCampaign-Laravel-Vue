<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Country</h1>
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

              <bootstrap-alert />
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i> Loading
                  </div>
                </div>
              </div>
              <div class="box-body" v-if="!loading">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="country">Country</label>
                    <v-select @change="updateCountryInfo" :options="countryList" label="name">
                      <template slot="option" slot-scope="country">
                        <country-flag :country="country.code" size="normal" class="flag-icon" />
                        <span class="country-label">{{ country.name}}</span>
                      </template>
                    </v-select>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="country">Currency</label>
                    <v-select @change="updateCurrency" :options="currencies" label="code">
                      <template slot="option" slot-scope="currency">
                        <span class="country-label">{{ currency.code + ' ' + currency.symbol}}</span>
                      </template>
                    </v-select>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="title">Price per SMS</label>
                    <input
                      type="number"
                      step="any"
                      min="0.01"
                      class="form-control"
                      name="price"
                      placeholder="Enter Initial Price"
                      @input="updateInitialPrice"
                      required
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="title">Extra Price</label>
                    <input
                      type="number"
                      step="any"
                      class="form-control"
                      name="extraPrice"
                      placeholder="Enter Extra Price"
                      @input="updateExtraPrice"
                      required
                    />
                  </div>
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
const ct = require("countries-and-timezones");

export default {
  data() {
    return {
      // Code...
      countryList: [],
      countryInfo: null
    };
  },
  computed: {
    ...mapGetters("CountriesSingle", ["item", "loading", "currencies"])
  },
  created() {
    // Code ...
    this.fetchCurrencyData().then(() => {
      this.init();
    });
  },
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("CountriesSingle", [
      "storeData",
      "resetState",
      "setInitialPrice",
      "setExtraPrice",
      "setCountryInfo",
      "setCurrency",
      "fetchCurrencyData"
    ]),
    init() {
      const countries = ct.getAllCountries();
      for (var key in countries) {
        if (!countries.hasOwnProperty(key)) continue;
        if (!countries[key].hasOwnProperty("name")) continue;
        if (!countries[key].hasOwnProperty("id")) continue;
        this.countryList.push({
          name: countries[key].name,
          code: countries[key].id
        });
      }
    },
    updateInitialPrice(e) {
      this.setInitialPrice(e.target.value);
    },
    updateExtraPrice(e) {
      this.setExtraPrice(e.target.value);
    },
    updateCountryInfo(value) {
      console.log(value);
      this.setCountryInfo(value);
    },
    updateCurrency(value) {
      this.setCurrency(value.id);
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({
            name: "countries.index"
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
.flag-icon {
  display: block;
  float: left;
  margin-top: -22px;
  margin-left: -20px;
}

.country-label {
  padding-left: 15px;
  font-size: 18px;
  font-weight: 600;
}
</style>
