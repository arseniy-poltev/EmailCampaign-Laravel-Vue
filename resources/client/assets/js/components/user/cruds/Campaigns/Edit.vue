<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>{{ trans('backend.txt_campaign') }}</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <form @submit.prevent="submitForm">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{ trans('backend.txt_edit') }}</h3>
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
                <div class="row form-group">
                  <div
                    class="alert alert-info alert-dismissible col-md-6"
                    style="margin-left:20px"
                    v-if="item.count_customers>=0"
                  >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ parse(trans('backend.txt_detail_3'), item.count_customers) }}
                    <h3>{{ trans('backend.txt_total_price') }} = {{totalPrice}}</h3>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title">
                    <i class="fas fa-book margin-r-5"></i>
                    {{ trans('backend.txt_campaign_name') }}*
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    :placeholder="trans('backend.txt_place_campaign')"
                    :value="item.name"
                    @input="updateName"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="title">
                    <i class="fas fa-user-tie margin-r-5"></i>
                    {{ trans('backend.txt_sms_sender') }}*
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    name="sender_name"
                    :placeholder="trans('backend.txt_place_sender')"
                    :value="item.sender_name"
                    @input="updateSenderName"
                    required
                  />
                </div>
                <div class="form-group date-region">
                  <label for="description">
                    <i class="fas fa-clock margin-r-5"></i>
                    {{ trans('backend.txt_delivery_date') }}
                  </label>
                  <h4>{{ trans('backend.txt_send_frequency') }}</h4>
                  <div class="form-group">
                    <div class="radio">
                      <label>
                        <input
                          type="radio"
                          name="optionsRadios"
                          id="optionsRadios1"
                          :value="false"
                          v-model="flagInterval"
                          checked
                        />
                        {{ trans('backend.txt_send_together') }}
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input
                          type="radio"
                          name="optionsRadios"
                          id="optionsRadios2"
                          :value="true"
                          v-model="flagInterval"
                        />
                        Send with interval of
                        <input
                          type="number"
                          class="form-control inline-input"
                          style="display:inline-block"
                          name="interval_cnt"
                          :value="item.interval_cnt"
                          :min="1"
                          :disabled="!flagInterval"
                          @input="updateIntervalCnt"
                          required
                        /> SMSs each
                        <input
                          type="number"
                          class="form-control inline-input"
                          style="display:inline-block"
                          name="interval_time"
                          :value="item.interval_time"
                          :min="1"
                          :disabled="!flagInterval"
                          @input="updateIntervalTime"
                          required
                        /> min.
                      </label>
                    </div>
                  </div>
                  <h4>{{ trans('backend.txt_start_soon') }}</h4>
                  <div class="onoffswitch">
                    <input
                      type="checkbox"
                      name="onoffswitch"
                      class="onoffswitch-checkbox"
                      id="myonoffswitch"
                      v-model="flagStart"
                      checked
                    />
                    <label class="onoffswitch-label" for="myonoffswitch"></label>
                  </div>
                  <br />
                  <div v-show="!flagStart">
                    <label>{{ trans('backend.txt_start_date') }}</label>
                    <v-select
                      :options="timezoneList"
                      @change="updateTimeZone"
                      :value="timezone"
                      :reduce="country => country.label"
                      id="zonePicker"
                    >
                      <template slot="option" slot-scope="zone">
                        <country-flag :country="zone.country" size="normal" class="flag-icon" />
                        <span class="zone-label">{{ zone.label + '(UTC ' + zone.offsetUTC + ')'}}</span>
                      </template>
                    </v-select>
                    <br />
                    <date-picker
                      id="datePicker"
                      @input="updateStartTime"
                      :value="date"
                      :config="options"
                    ></date-picker>
                  </div>
                </div>
                <div class="form-group">
                  <label for="description">
                    <i class="fas fa-comment-dots margin-r-5"></i>
                    {{ trans('backend.txt_sms_message') }} *
                  </label>
                  <textarea
                    rows="6"
                    class="form-control"
                    name="message"
                    :placeholder="trans('backend.txt_place_message')"
                    :value="item.message"
                    @input="updateMessage"
                    required
                  ></textarea>
                </div>
                <div class="form-group">
                  <label for="description">
                    <i class="fas fa-comments margin-r-5"></i>
                    {{ trans('backend.txt_extra_comment') }}
                  </label>
                  <textarea
                    rows="4"
                    class="form-control"
                    name="message"
                    :placeholder="trans('backend.txt_place_extra')"
                    :value="item.comment"
                    @input="updateComment"
                  ></textarea>
                </div>
              </div>

              <div class="box-footer">
                <vue-button-spinner
                  class="btn btn-primary btn-sm"
                  :isLoading="loading"
                  :disabled="loading"
                  :clickFunc="btnSaveClick"
                >{{ trans('backend.txt_save_draft') }}</vue-button-spinner>
                <vue-button-spinner
                  class="btn btn-danger btn-sm"
                  :isLoading="loading"
                  :disabled="loading"
                  :clickFunc="btnSendClick"
                >{{ trans('backend.txt_ask_approval') }}</vue-button-spinner>
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
import CountryFlag from "vue-country-flag";
const ct = require("countries-and-timezones");

export default {
  data() {
    return {
      // Code...
      date: new Date(),
      options: {
        format: "YYYY-MM-DD h:mm:ss",
        useCurrent: false,
        showClear: true,
        showClose: true
      },
      flagStart: true,
      flagInterval: false,
      timezoneList: [],
      timezone: null
    };
  },
  computed: {
    ...mapGetters("CampaignsSingle", ["item", "loading", "totalPrice"])
  },
  created() {
    const timezones = ct.getAllTimezones();

    for (var key in timezones) {
      if (!timezones.hasOwnProperty(key)) continue;
      if (!timezones[key].hasOwnProperty("countries")) continue;
      if (!timezones[key].hasOwnProperty("offsetStr")) continue;

      for (var j in timezones[key].countries) {
        this.timezoneList.push({
          label: key,
          country: timezones[key].countries[j].toLowerCase(),
          offsetUTC: timezones[key].offsetStr
        });
      }
    }

    this.fetchData(this.$route.params.id).then(() => {
      this.init();
    });
  },
  destroyed() {
    //this.resetState();
  },
  watch: {
    "$route.params.id": function() {
      //this.resetState();
      //this.fetchData(this.$route.params.id);
    },
    flagInterval: {
      handler: function() {
        if (!this.flagInterval) {
          this.setIntervalCnt(null);
          this.setIntervalTime(null);
        }
      }
    },
    flagStart: {
      handler: function() {
        console.log(this.flagStart);
        if (this.flagStart) {
          this.setStartTime(null);
          this.setTimezone(null);
        } else {
          console.log($("#datePicker").val());

          if (this.item.schedule_time == null) {
            this.setStartTime($("#datePicker").val());
            this.setTimezone(this.timezone);
          }
        }
      }
    }
  },
  components: {
    CountryFlag
  },
  mounted() {
    this.flagInterval = this.item.interval_cnt > 0;
    if (this.item.interval_cnt == 0) {
      this.setIntervalCnt(null);
      this.setIntervalTime(null);
    }
  },
  methods: {
    ...mapActions("CampaignsSingle", [
      "resetState",
      "fetchData",
      "updateData",
      "setName",
      "setSenderName",
      "setMessage",
      "setComment",
      "setStartTime",
      "setTimezone",
      "setIntervalTime",
      "setIntervalCnt"
    ]),
    init() {
      if (this.item.timezone != null) {
        this.timezone = this.item.timezone;
      } else {
        this.timezone = window.timezone.guess();
      }
      if (this.item.schedule_time != null) {
        this.date = this.item.schedule_time;
      }
      this.flagStart = this.item.schedule_time == null;
    },
    updateName(e) {
      this.setName(e.target.value);
    },
    updateSenderName(e) {
      this.setSenderName(e.target.value);
    },
    updateMessage(e) {
      this.setMessage(e.target.value);
    },
    updateComment(e) {
      this.setComment(e.target.value);
    },
    updateIntervalCnt(e) {
      this.setIntervalCnt(e.target.value);
    },
    updateIntervalTime(e) {
      this.setIntervalTime(e.target.value);
    },
    updateTimeZone(value) {
      if (this.flagStart) {
        return;
      }
      //this.timezone = value.label;
      if (typeof value === "object" && value.hasOwnProperty("label")) {
        this.timezone = value.label;
        this.setTimezone(value.label);
      } else {
        this.timezone = value;
        this.setTimezone(value);
      }
    },
    updateStartTime(value) {
      //console.log(value);
      if (this.flagStart) {
        return;
      }
      this.setStartTime(value);
    },
    btnSaveClick() {
      this.submitForm(true);
    },
    btnSendClick() {
      this.submitForm(false);
    },
    parse(str) {
      var args = [].slice.call(arguments, 1),
        i = 0;
      return str.replace(/%d/g, () => args[i++]);
    },
    submitForm(flag) {
      this.updateData(flag)
        .then(() => {
          this.resetState();
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
  float: left;
  margin-top: -22px;
  margin-left: -20px;
}

.zone-label {
  padding-left: 15px;
  font-size: 18px;
  font-weight: 600;
}
.date-region {
  border-style: dashed;
  border-color: gray;
  border-width: 1px;
  padding: 15px;
  margin-bottom: 20px !important;
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
.inline-input {
  display: inline-block;
  width: 80px;
  margin-left: 5px;
  margin-right: 5px;
  padding-top: 5px;
  padding-right: 0px;
  padding-bottom: 5px;
  border-radius: 5px;
  font-size: 18px;
  margin-top: -10px;
}
</style>
