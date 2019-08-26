<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Country</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-4">
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
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="country">Country</label>
                    <v-select
                      @input="updateCountryInfo"
                      :options="countryList"
                      label="name"
                      :value="item.name"
                    >
                      <template slot="option" slot-scope="country">
                        <country-flag :country="country.code" size="normal" class="flag-icon" />
                        <span class="country-label">{{ country.name}}</span>
                      </template>
                    </v-select>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="country">Currency</label>
                    <v-select
                      @input="updateCurrency"
                      :options="currencies"
                      label="code"
                      :value="item.currency"
                    >
                      <template slot="option" slot-scope="currency">
                        <span class="country-label">{{ currency.code + ' ' + currency.symbol}}</span>
                      </template>
                    </v-select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="title">Initial Price</label>
                    <input
                      type="number"
                      step="any"
                      min="0.01"
                      class="form-control"
                      name="price"
                      placeholder="Enter Initial Price"
                      :value="item.initial_price"
                      @input="updateInitialPrice"
                      required
                    />
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="title">Extra Price</label>
                    <input
                      type="number"
                      step="any"
                      class="form-control"
                      name="extraPrice"
                      placeholder="Enter Extra Price"
                      :value="item.extra_price"
                      @input="updateExtraPrice"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="mapFile">Map File</label>
                    <div></div>
                    <button
                      v-if="item.map_file || item.map_file_url"
                      class="btn btn-danger"
                      @click="onRemoveMapFile"
                    >Remove</button>
                    <span
                      class="file-row"
                      v-if="item.map_file || item.map_file_url"
                    >{{item.map_file_url}}</span>
                    <input
                      ref="mapFile"
                      type="file"
                      accept=".js"
                      name="mapFile"
                      v-on:change="onMapFileChanged"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <h4>Activate/Inactivate</h4>
                    <div class="onoffswitch">
                      <input
                        type="checkbox"
                        name="onoffswitch"
                        class="onoffswitch-checkbox"
                        id="myonoffswitch"
                        @input="updateActivateFlag"
                        :checked="item.activated==1"
                      />
                      <label class="onoffswitch-label" for="myonoffswitch"></label>
                    </div>
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

        <div class="col-md-8">
          <div class="box" style="background-color:#fef3f3">
            <div class="box-header with-border">
              <country-flag v-if="item.code" :country="item.code" size="big" class="flag-icon1" />
              <br />
              <div v-if="availableUsersCnt">
                <i class="fas fa-users" style="font-size: 28px;"></i>
                <span style="font-size:30px">Available Users: {{availableUsersCnt}}</span>
              </div>
            </div>
            <div class="row" v-if="loading">
              <div class="col-xs-4 col-xs-offset-4">
                <div class="alert text-center">
                  <i class="fa fa-spin fa-refresh"></i> Loading
                </div>
              </div>
            </div>

            <div class="box-body">
              <div id="world-map" class="jvmap-smart"></div>
              <div style="padding-top:15px;">
                <button
                  type="button"
                  class="btn btn-block btn-danger btn-lg"
                  @click="callService"
                  :disabled="callingService"
                >Get Avaliable Users</button>
              </div>
            </div>
          </div>
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
      worldMap: null,
      availableUsersCnt: null,
      countryList: [],
      callingService: false
    };
  },
  computed: {
    ...mapGetters("CountriesSingle", ["item", "loading", "currencies"])
  },
  created() {
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
    this.fetchCurrencyData();
    this.fetchData(this.$route.params.id).then(() => {
      this.setFocus();
      //this.initMap();
    });
  },
  destroyed() {
    this.resetState();
  },
  mounted() {
    this.initMap();
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchCurrencyData();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("CountriesSingle", [
      "resetState",
      "fetchData",
      "updateData",
      "setInitialPrice",
      "setExtraPrice",
      "setCountryInfo",
      "setCurrency",
      "setActivateFlag",
      "setMapFile",
      "fetchCurrencyData"
    ]),
    initMap() {
      var parent = this;
      this.worldMap = new jvm.Map({
        container: $("#world-map"),
        map: "world_mill",
        markerStyle: {
          initial: {
            fill: "#F8E23B",
            stroke: "#383f47"
          }
        },
        regionStyle: {
          initial: {
            fill: "#656565"
          },
          selected: {
            fill: "#F4A582"
          },
          hover: {
            fill: "#c67900"
          }
        },
        backgroundColor: "#ffffff"
      });
      //this.setFocus();
    },
    setFocus() {
      if (this.worldMap) {
        this.worldMap.setFocus({
          region: this.item.code,
          animate: true
        });
      }
    },
    callService() {
      this.callingService = true;
      var parent = this;
      axios
        .get("/api/v1/getAvailableUsers/" + this.item.code)
        .then(response => {
          parent.availableUsersCnt = response.data.recipients;
        })
        .catch(error => {
          let message = error.response.data.message || error.message;
          let errors = error.response.data.errors;
          dispatch(
            "Alert/setAlert",
            { message: message, errors: errors, color: "danger" },
            { root: true }
          );
        })
        .finally(() => {
          this.callingService = false;
        });
    },
    updateInitialPrice(e) {
      this.setInitialPrice(e.target.value);
    },
    updateExtraPrice(e) {
      this.setExtraPrice(e.target.value);
    },
    updateCountryInfo(value) {
      console.log(value);
      this.setActivateFlag(0);
      this.setCountryInfo(value);
      this.setFocus();
    },
    updateCurrency(value) {
      this.setCurrency(value.id);
    },
    updateActivateFlag(e) {
      this.setActivateFlag(e.target.checked ? 1 : 0);
    },
    onMapFileChanged(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.setMapFile(files[0]);
    },
    onRemoveMapFile() {
      this.$refs.mapFile.value = null;
      this.setMapFile(null);
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({
            name: "countries.index"
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
.jvmap-smart {
  height: 400px;
}
.flag-icon1 {
  margin-top: 1px;
  /* background-color: #f0f0f0; */
}

.onoffswitch {
  position: relative;
  width: 55px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}
.onoffswitch-checkbox {
  display: none;
}
.onoffswitch-label {
  display: block;
  overflow: hidden;
  cursor: pointer;
  height: 20px;
  padding: 0;
  line-height: 20px;
  border: 2px solid #ffffff;
  border-radius: 20px;
  background-color: #9e9e9e;
  transition: background-color 0.3s ease-in;
}
.onoffswitch-label:before {
  content: "";
  display: block;
  width: 20px;
  margin: 0px;
  background: #ffffff;
  position: absolute;
  top: 0;
  bottom: 0;
  right: 33px;
  border: 2px solid #ffffff;
  border-radius: 20px;
  transition: all 0.3s ease-in 0s;
}
.onoffswitch-checkbox:checked + .onoffswitch-label {
  background-color: #42a5f5;
}
.onoffswitch-checkbox:checked + .onoffswitch-label,
.onoffswitch-checkbox:checked + .onoffswitch-label:before {
  border-color: #42a5f5;
}
.onoffswitch-checkbox:checked + .onoffswitch-label:before {
  right: 0px;
}
.file-row {
  background-color: dimgray;
  font-size: 20px;
  color: white;
  padding: 3px;
}
</style>
