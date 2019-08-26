<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>{{ trans('backend.txt_campaign') }}</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('backend.txt_create') }}</h3>
            </div>

            <div class="box-body">
              <back-buttton></back-buttton>
            </div>

            <bootstrap-alert />
            <div class="row" v-if="loading">
              <div class="col-xs-4 col-xs-offset-4">
                <div class="alert text-center">
                  <i class="fa fa-spin fa-refresh"></i>
                  {{ trans('backend.txt_loading') }}
                </div>
              </div>
            </div>
            <div class="box-body" v-if="!loading">
              <div class="form-group filter-region">
                <label for="description" style="font-size:40px">
                  <i class="fas fa-filter margin-r-5"></i>
                  {{ trans('backend.txt_filter') }}
                </label>
                <div class="row" style="padding:20px">
                  <div class="form-group col-md-2">
                    <div>
                      <label>
                        <i class="fas fa-venus-double margin-r-5"></i>
                        {{ trans('backend.txt_sex') }}
                      </label>
                      <div
                        class="radio"
                        v-for="(sex, index) in initalFilters[0].possibleVals"
                        v-bind:key="sex"
                      >
                        <label>
                          <input
                            type="radio"
                            :id="'gender'+index"
                            :value="sex"
                            v-model="initalFilters[0].value"
                          />
                          {{sex}}
                        </label>
                      </div>
                    </div>
                    <br />
                    <div>
                      <label>
                        <i class="fas fa-infinity margin-r-5"></i>
                        {{ trans('backend.txt_age') }}
                      </label>
                      <br />
                      {{ trans('backend.txt_min') }}:
                      <select
                        id="minAgeSel"
                        v-model="initalFilters[1].value.minValue"
                      >
                        <option
                          v-for="age in initalFilters[1].possibleVals.slice(0,initalFilters[1].possibleVals.indexOf(initalFilters[1].value.maxValue)+1)"
                          v-bind:key="age"
                          :value="age"
                        >{{age}}</option>
                      </select>
                      {{ trans('backend.txt_max') }}:
                      <select
                        id="maxAgeSel"
                        v-model="initalFilters[1].value.maxValue"
                      >
                        <option
                          v-for="age in initalFilters[1].possibleVals.slice(initalFilters[1].possibleVals.indexOf(initalFilters[1].value.minValue))"
                          v-bind:key="age"
                          :value="age"
                        >{{age}}</option>
                      </select>
                    </div>

                    <div class="region-summary">
                      <country-flag
                        v-if="selectedCountry!=null"
                        :country="selectedCountry"
                        size="normal"
                        class="flag-icon"
                      />
                      <label>
                        <i class="fas fa-map-marker-alt margin-r-5"></i>
                        {{ trans('backend.txt_region') }}
                      </label>

                      <br />
                      <a
                        v-if="filterRegionArr.length > 0"
                        href="#"
                        @click="onBtnClear"
                      >{{ trans('backend.txt_clear_selection') }}</a>
                      <div>
                        <div
                          class="region-item"
                          v-for="region in filterRegionArr"
                          v-bind:key="region"
                          @click="removeRegion(region)"
                        >
                          <i class="fas fa-minus-circle"></i>
                          {{region}}
                        </div>
                      </div>
                    </div>

                    <br />
                  </div>
                  <div class="form-group col-md-3">
                    <div class="box-group" id="accordion">
                      <div class="panel box box-primary">
                        <div class="box-header with-border">
                          <h4 class="box-title">
                            <a
                              data-toggle="collapse"
                              data-parent="#accordion"
                              href="#collapseOne"
                            >{{ trans('backend.txt_extra_filters') }}</a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="box-body">
                            <!-- <div class="alert alert-info alert-dismissible">
                              <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-hidden="true"
                              >×</button>
                              <h4>
                                <i class="icon fa fa-info"></i>
                                {{ trans('backend.txt_alert') }}
                              </h4>
                              {{ trans('backend.txt_alert_desc') }}
                            </div>-->
                            <div class="extra-filter-region" v-if="extraFilters.length > 0">
                              <div v-for="(filter, index) in extraFilters" v-bind:key="index">
                                <div v-if="filter.type == 0">
                                  <label>
                                    <!-- <i class="fas fa-mars-double margin-r-5"></i> -->
                                    {{filter.name}}
                                  </label>
                                  <div
                                    class="radio"
                                    v-for="(status,index) in filter.possibleVals"
                                    v-bind:key="status"
                                  >
                                    <label>
                                      <input
                                        type="radio"
                                        :id="'status'+index"
                                        :value="status"
                                        v-model="filter.value"
                                      />
                                      {{status}}
                                    </label>
                                  </div>
                                </div>
                                <div v-if="filter.type == 1">
                                  <label>
                                    <!-- <i class="fas fa-money-bill margin-r-5"></i> -->
                                    {{filter.name}}
                                  </label>
                                  <br />
                                  {{ trans('backend.txt_min') }}:
                                  <select
                                    id="minSalarySel"
                                    v-model="filter.value.minValue"
                                  >
                                    <option
                                      v-for="salary in (filter.value.maxValue != '' ? filter.possibleVals.slice(0,filter.possibleVals.indexOf(filter.value.maxValue)+1):filter.possibleVals)"
                                      v-bind:key="salary"
                                      :value="salary"
                                    >{{salary}}</option>
                                  </select>
                                  {{ trans('backend.txt_max') }}:
                                  <select
                                    id="maxSalarySel"
                                    v-model="filter.value.maxValue"
                                  >
                                    <option
                                      v-for="salary in (filter.value.minValue != '' ? filter.possibleVals.slice(filter.possibleVals.indexOf(filter.value.minValue)):filter.possibleVals)"
                                      v-bind:key="salary"
                                      :value="salary"
                                    >{{salary}}</option>
                                  </select>
                                </div>
                                <br />
                              </div>
                              <br />
                              <button
                                type="button"
                                class="btn btn-block btn-default"
                                @click="clearExtraFilter"
                              >{{ trans('backend.txt_clear_filter') }}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#tab_1" data-toggle="tab">{{ trans('backend.txt_map') }}</a>
                        </li>
                        <li>
                          <a href="#tab_2" data-toggle="tab">{{ trans('backend.txt_postal_code') }}</a>
                        </li>
                        <li>
                          <a href="#tab_3" data-toggle="tab">{{ trans('backend.txt_state') }}</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                          <div id="world-map" class="jvmap-smart"></div>
                          <div id="country-map" class="jvmap-smart" hidden></div>
                          <div class="row">
                            <a
                              href="#"
                              id="btnBackToWMap"
                              style="float:right"
                              hidden
                              @click="back2WMap"
                            >{{ trans('backend.txt_back_map') }}</a>
                          </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                          <div class="form-group">
                            <label for="edtPostalCode">{{ trans('backend.txt_postal_code') }}</label>
                            <input
                              type="number"
                              class="form-control"
                              id="edtPostalCode"
                              :placeholder="trans('backend.txt_place_postal_code')"
                            />
                          </div>
                          <button
                            type="button"
                            class="btn btn-block btn-info"
                            @click="addPostalCode"
                          >{{ trans('backend.txt_add') }}</button>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                          <div class="row" v-if="stateLoading">
                            <div class="col-xs-4 col-xs-offset-4">
                              <div class="alert text-center">
                                <i class="fa fa-spin fa-refresh"></i>
                                {{ trans('backend.txt_loading') }}
                              </div>
                            </div>
                          </div>
                          <div class="state-part" v-if="!stateLoading">
                            <div v-if="states.length == 0">
                              <p>{{ trans('backend.txt_no_state') }}</p>
                            </div>
                            <div
                              class="region-item"
                              v-for="(state,index) in states"
                              v-bind:key="index"
                              :id="state.name"
                              @click="onStateItemClick"
                            >
                              <i class="fas fa-plus-circle"></i>
                              {{state.name}}
                            </div>
                          </div>
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                  </div>
                </div>
                <div
                  class="alert alert-success alert-dismissible col-md-6"
                  v-if="maxCountOfUsers>=0"
                >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>
                    <i class="icon fa fa-check"></i>
                    {{ trans('backend.txt_filter_1') }}:
                    <strong
                      style="font-size:38px"
                    >{{maxCountOfUsers}}</strong>
                  </h4>
                  {{ trans('backend.txt_filter_2') }}:
                  <input
                    type="number"
                    class="form-control custome-input"
                    name="customer_cnt"
                    :value="countOfUsers"
                    :max="maxCountOfUsers"
                    :min="1"
                    @input="updateCustomerCnt"
                    required
                  />
                  <h3>{{ trans('backend.txt_price_per_sms') }} = {{getPricePerSMS}}</h3>
                  <h3>{{ trans('backend.txt_total_price') }} = {{getTotalPrice}}</h3>
                </div>

                <div class="row" style="padding-left:15px;padding-right:15px">
                  <button
                    type="button"
                    class="btn btn-block btn-info btn-lg"
                    @click="callService"
                    :disabled="callingService"
                  >{{ trans('backend.txt_call_service') }}</button>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <vue-button-spinner
                class="btn btn-primary btn-sm"
                :isLoading="loading"
                :disabled="loading||maxCountOfUsers==-1"
                :clickFunc="btnNextClick"
              >{{ trans('backend.txt_next_step') }}</vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import csc from "country-state-city";
var allCountry = csc.getAllCountries();

export default {
  data() {
    return {
      // Code...

      worldMap: null,
      countryMap: null,
      // mapData: ["es", "fr", "it", "de", "pt"],
      isWorldMap: true,

      callingService: false,
      WSResult: null,
      countOfUsers: -1,
      maxCountOfUsers: -1,
      priceInfo: {
        pricePerSMS: 0,
        currencyCode: "",
        currencySymbol: ""
      },
      yourInfo: null,
      selectedCountry: null,

      filterRegionArr: [],
      initalFilters: [
        {
          name: "cGender",
          value: "Male",
          possibleVals: ["Male", "Female", "Both"]
        },
        {
          name: "cAge",
          value: {
            minValue: "18",
            maxValue: "66+"
          },
          possibleVals: []
        }
      ],
      extraFilters: [],
      // extraFilters: [
      //   {
      //     name: "cSalary",
      //     value: {
      //       minValue: "",
      //       maxValue: ""
      //     },
      //     possibleVals: [""]
      //   },
      //   {
      //     name: "cMaritalStatus",
      //     value: "",
      //     possibleVals: ["Single", "Married", "Separated", "Divorced"]
      //   }
      // ],
      prevTempCnt: 0,
      stateLoading: false,
      states: [],
      campaignId: this.$route.params.id
    };
  },
  watch: {
    initalFilters: {
      handler: function() {
        this.maxCountOfUsers = -1;
      },
      deep: true,
      immediate: true
    },
    extraFilters: {
      handler: function() {
        this.maxCountOfUsers = -1;
      },
      deep: true,
      immediate: true
    },
    filterRegionArr: {
      handler: function() {
        this.maxCountOfUsers = -1;
      },
      deep: true,
      immediate: true
    },
    selectedCountry: {
      handler: function() {
        this.getAllStates();
      },
      deep: true,
      immediate: true
    }
  },
  computed: {
    ...mapGetters("CampaignsSingle", [
      "item",
      "loading",
      "activeCont",
      "mapData"
    ]),
    getTotalPrice: function() {
      var totalPrice = (this.priceInfo.pricePerSMS * this.countOfUsers).toFixed(
        2
      );
      return (
        totalPrice +
        this.priceInfo.currencySymbol +
        "(" +
        this.priceInfo.currencyCode +
        ")"
      );
    },
    allStates: function() {
      // if (this.selectedCountry == null) {
      //   return [];
      // }
      // var countryCode = this.selectedCountry;
      // var x = allCountry.find(function(element) {
      //   return element.sortname == countryCode;
      // });
      // return csc.getStatesOfCountry(x.id);
    },
    getPricePerSMS: function() {
      return this.priceInfo.pricePerSMS + this.priceInfo.currencySymbol;
    }
  },
  created() {
    // Code ...
    for (var i = 18; i < 66; i++) {
      this.initalFilters[1].possibleVals.push(i + "");
    }
    this.initalFilters[1].possibleVals.push(i + "+");

    // for (var j = 500; j < 10000; j += 500) {
    //   this.extraFilters[0].possibleVals.push(j + "");
    // }
    // this.extraFilters[0].possibleVals.push(j + "+");
    //set saved data
    this.getActiveCont().then(filterKeys => {
      var temp = filterKeys;
      for (var i in temp) {
        // if range
        if (temp[i].type == 1) {
          for (
            var j = temp[i].data.minValue;
            j < temp[i].data.maxValue;
            j += temp[i].data.step
          ) {
            temp[i].possibleVals.push(j + "");
          }
          temp[i].possibleVals.push(j + "+");
        }
      }
      this.extraFilters = temp;

      this.fetchData(this.campaignId).then(() => {
        this.initMap();
        if (this.setSavedData()) {
          this.callService();
        }
        axios.get("https://ipinfo.io/json?token=ec390afea81cee").then(resp => {
          resp = resp.data;

          var countryCode = resp && resp.country ? resp.country : "";
          this.yourInfo = resp;
          if (this.selectedCountry == null) {
            this.selectedCountry = countryCode;
          }
          console.log(resp);
          this.drawMap();
        });
      });
    });
  },
  destroyed() {},

  beforeRouteLeave(to, from, next) {
    var tokens = to.name.split(".");
    if (tokens[tokens.length - 1] != "setup") {
      this.resetState();
    }
    next();
  },
  mounted() {},
  methods: {
    ...mapActions("CampaignsSingle", [
      "fetchData",
      "getActiveCont",
      "resetState",
      "getTargetUsersCnt",
      "setFilter",
      "setTotalPrice",
      "setCountCustomer"
    ]),
    getAllStates() {
      if (this.selectedCountry == null) {
        this.states = [];
        return;
      }
      this.states = [];
      var countryCode = this.selectedCountry;
      this.stateLoading = true;
      axios
        .get("/api/country/" + countryCode + "/states")
        .then(response => {
          console.log(response.data);
          this.states = response.data.data;
        })
        .finally(() => {
          this.stateLoading = false;
        });
    },
    setSavedData() {
      if (this.item.filter == null) {
        return false;
      }
      var filter = JSON.parse(this.item.filter);
      console.log(filter);
      this.selectedCountry = filter.cCountry;
      this.filterRegionArr = filter.cRegion;
      this.initalFilters[0].value = filter.cGender;

      var temp = filter.cAge.split("-");
      this.initalFilters[1].value.minValue = temp[0];
      this.initalFilters[1].value.maxValue = temp[1];

      for (var key in filter.extra) {
        console.log(key);
        var index = this.getIndexOfExtraFilter(key);
        if (index == -1) {
          continue;
        }
        if (filter.extra[key].indexOf("-") != -1) {
          temp = filter.extra[key].split("-");
          this.extraFilters[index].value.minValue = temp[0];
          this.extraFilters[index].value.maxValue = temp[1];
        } else {
          this.extraFilters[index].value = filter.extra[key];
        }
      }
      return true;
    },
    getIndexOfExtraFilter(jsonName) {
      for (var i in this.extraFilters) {
        if (this.extraFilters[i].jsonName === jsonName) {
          return i;
        }
      }
      return -1;
    },
    clearExtraFilter() {
      for (var i in this.extraFilters) {
        if (this.extraFilters[i].type == 1) {
          this.extraFilters[i].value.minValue = this.extraFilters[
            i
          ].value.maxValue =
            "";
        } else {
          this.extraFilters[i].value = "";
        }
      }
    },
    makeFilterParameter() {
      //validation for basic filter
      //make json
      if (this.selectedCountry == null) {
        alert("Please select country!");
        return null;
      }
      var param = {
        cCountry: this.selectedCountry,
        cRegion: this.filterRegionArr,
        cGender: this.initalFilters[0].value,
        cAge:
          this.initalFilters[1].value.minValue +
          "-" +
          this.initalFilters[1].value.maxValue
      };
      param["extra"] = {};
      for (var i in this.extraFilters) {
        if (this.extraFilters[i].type == 1) {
          if (
            this.extraFilters[i].value.minValue != "" &&
            this.extraFilters[i].value.maxValue != ""
          ) {
            param["extra"][this.extraFilters[i].jsonName] =
              this.extraFilters[i].value.minValue +
              "-" +
              this.extraFilters[i].value.maxValue;
          }
        } else {
          if (this.extraFilters[i].value != "") {
            param["extra"][this.extraFilters[i].jsonName] = this.extraFilters[
              i
            ].value;
          }
        }
      }

      return param;
    },
    callService(e) {
      var param = this.makeFilterParameter();
      if (param == null) {
        return;
      }
      console.log(param);
      this.maxCountOfUsers = -1;
      this.callingService = true;
      this.getTargetUsersCnt(param)
        .then(result => {
          console.log(result);
          if (this.item.count_customers) {
            this.countOfUsers = this.item.count_customers;
          } else {
            this.countOfUsers = result.recipients;
          }

          if (this.countOfUsers > result.recipients) {
            this.countOfUsers = result.recipients;
          }

          this.maxCountOfUsers = result.recipients;
          this.priceInfo.pricePerSMS = result.price_per_sms;
          this.priceInfo.currencyCode = result.currency_code;
          this.priceInfo.currencySymbol = result.currency_symbol;
        })
        .catch(error => {
          console.error(error);
        })
        .finally(() => {
          this.callingService = false;
        });
    },
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
        series: {
          regions: [
            {
              scale: {
                active: "#dd4b39",
                not: "#656565"
              },
              attribute: "fill",
              values: parent.activeCont,
              legend: {
                horizontal: true,
                title: "Recommened"
              }
            }
          ]
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
        backgroundColor: "#ffffff",
        onRegionClick: function(e, code) {
          console.log(code);
          parent.showCountryMap(code);
        }
      });
    },
    drawMap() {
      var markers = [];
      if (this.yourInfo != null && this.yourInfo != undefined) {
        var loc = this.yourInfo.loc.split(",");
        markers.push({
          latLng: [Number(loc[0]), Number(loc[1])],
          name: this.yourInfo.city
        });
        if (this.worldMap) {
          this.worldMap.addMarkers(markers);
          this.worldMap.setFocus({
            region: this.selectedCountry,
            animate: true
          });
        }
      }
    },
    drawCountryMap(countryCode) {
      var parent = this;
      var mapName = countryCode + "_mill";
      delete this.countryMap;

      this.countryMap = new jvm.Map({
        container: $("#country-map"),
        map: mapName,
        regionsSelectable: true,
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
        regionLabelStyle: {
          initial: {
            fill: "black"
          },
          hover: {
            fill: "black"
          }
        },
        labels: {
          regions: {
            render: function(code) {
              return code.split("-")[1];
            }
          }
        },
        markerStyle: {
          initial: {
            fill: "#F8E23B",
            stroke: "#383f47"
          }
        },
        backgroundColor: "#ffffff",
        onRegionClick: function(e, code) {
          console.log(code);
          var index = parent.filterRegionArr.indexOf(code);
          if (index != -1) {
            parent.filterRegionArr.splice(index, 1);
          } else {
            parent.filterRegionArr.push(code);
          }
        }
      });
      if (this.yourInfo != null && this.yourInfo != undefined) {
        var markers = [];
        var loc = this.yourInfo.loc.split(",");
        markers.push({
          latLng: [Number(loc[0]), Number(loc[1])],
          name: this.yourInfo.city
        });
        if (this.countryMap) {
          this.countryMap.addMarkers(markers);
        }
      }
      if (this.countryMap) {
        this.countryMap.setSelectedRegions(this.filterRegionArr);
      }
    },
    showCountryMap(code) {
      var parent = this;
      if (this.selectedCountry != code) {
        this.clearRegions();
      }
      this.selectedCountry = code;
      if (this.mapData.indexOf(code.toUpperCase()) == -1) {
        alert("We dont't support this country map!");
        //this.selectedCountry = null;
        return;
      }

      $("#world-map").fadeOut("easing", function() {
        parent.isWorldMap = false;
        $("#country-map").fadeIn("easing");
        parent.drawCountryMap(code.toLowerCase());
        $("#btnBackToWMap").show();
      });
    },
    back2WMap(e) {
      e.preventDefault();
      if (!this.isWorldMap) {
        var parent = this;
        $("#country-map").fadeOut("easing", function() {
          $("#country-map").empty();
          $("#world-map").fadeIn("easing");
          parent.isWorldMap = true;
          parent.selectedCountry = null;
          parent.clearRegions();
          $("#btnBackToWMap").hide();
        });
      }
    },
    onStateItemClick(e) {
      var code = e.target.id;
      var index = this.filterRegionArr.indexOf(code);
      if (index == -1 && code != "") {
        this.filterRegionArr.push(code);
      }
    },
    addPostalCode() {
      var postalCode = $("#edtPostalCode").val();
      if (postalCode == "") {
        $("#edtPostalCode").focus();
        return;
      }
      if (this.filterRegionArr.indexOf(postalCode) != -1) {
        alert("Already exist!");
        $("#edtPostalCode").focus();
        return;
      }
      $("#edtPostalCode").val("");
      $("#edtPostalCode").focus();
      this.filterRegionArr.push(postalCode);
    },
    clearRegions() {
      this.filterRegionArr = [];
      if (this.countryMap) {
        this.countryMap.clearSelectedRegions();
      }
    },
    onBtnClear(e) {
      e.preventDefault();
      this.clearRegions();
    },
    updateCustomerCnt(e) {
      var cnt = Number(e.target.value);
      if (cnt > this.maxCountOfUsers) {
        alert(
          "You have to set count of customers less than " + this.maxCountOfUsers
        );
        e.target.value = this.prevTempCnt;
      } else if (cnt == 0) {
        alert("Count of customers cannot be 0!");
        e.target.value = this.prevTempCnt;
      } else {
        this.prevTempCnt = cnt;
      }
      this.countOfUsers = this.prevTempCnt;
    },
    removeRegion(region) {
      var index = this.filterRegionArr.indexOf(region);
      if (index != -1) {
        this.filterRegionArr.splice(index, 1);
        var obj = {};
        obj[region] = false;
        if (this.countryMap) {
          this.countryMap.setSelectedRegions(obj);
        }
      }
    },

    btnNextClick() {
      if (this.countOfUsers < 1) {
        alert("No customers!");
        return;
      }
      this.setFilter(JSON.stringify(this.makeFilterParameter()));
      this.setCountCustomer(this.countOfUsers);
      this.setTotalPrice(this.getTotalPrice);

      if (this.campaignId == null || this.campaignId == undefined) {
        this.$router.push({
          name: "campaigns.setup"
        });
      } else {
        this.$router.push({
          name: "campaigns.edit.setup",
          params: {
            id: this.campaignId
          }
        });
      }
    }
  }
};
</script>

<style scoped>
.jvmap-smart {
  /* width: 600px; */
  height: 400px;
}
.filter-region {
  border-style: dashed;
  border-color: gray;
  border-width: 1px;
  padding: 5px;
  margin-bottom: 0px !important;
}
.extra-filter-region {
  border-style: dotted;
  border-color: gray;
  border-width: 1px;
  padding: 15px;
}
.region-summary {
  background-color: #deeff0;
  padding: 10px;
  margin-top: 35px;
}
.region-item {
  cursor: pointer;
}
.one-line {
  min-width: 100px;
  background: #eee;
  white-space: nowrap;
  overflow: hidden;
}
.temp-div {
  display: flex;
  justify-content: space-between;
}

.flag-icon {
  display: block;
  /* width: 40px; */
  /* height: 50px; */
  /* background: rgba(200, 255, 200, 1); */
  float: right;
  margin-top: -20px;
  margin-left: -20px;
}

.zone-label {
  padding-left: 15px;
  font-size: 18px;
  font-weight: 600;
}
.custome-input {
  font-size: 28px;
  font-weight: 900;
  width: 20%;
  padding-top: 6px;
  padding-bottom: 6px;
  padding-left: 6px;
  padding-right: 0px;
  text-align: right;
  color: white;
  background-color: #008d4c;
  border-radius: 5px;
  display: inline-block;
}
@media (min-width: 800px) {
  .custome-input {
    width: 30%;
  }
}
@media (min-width: 1400px) {
  .custome-input {
    width: 20%;
  }
}

.state-part {
  overflow-y: scroll;
  max-height: 300px;
  padding: 20px;
}
</style>
