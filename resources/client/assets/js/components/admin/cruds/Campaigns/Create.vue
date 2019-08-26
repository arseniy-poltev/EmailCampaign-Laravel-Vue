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
                <h3 class="box-title">Create</h3>
              </div>

              <div class="box-body">
                <back-buttton></back-buttton>
              </div>

              <bootstrap-alert/>

              <div class="box-body">
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
                <!-- <div class="form-group">
                  <label for="description">Select Region</label>
                  <div id="world-map" class="jvmap-smart"></div>
                </div> -->
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

require("jvectormap");
require("./jquery-jvectormap-world-mill");

export default {
  data() {
    return {
      // Code...
      worldMap: null
    };
  },
  computed: {
    ...mapGetters("CampaignsSingle", ["item", "loading"])
  },
  created() {
    // Code ...
  },
  destroyed() {
    this.resetState();
  },
  mounted() {
    this.drawMap();
  },
  methods: {
    ...mapActions("CampaignsSingle", [
      "storeData",
      "resetState",
      "setName",
      "setSenderName",
      "setMessage"
    ]),
    drawMap() {
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
        backgroundColor: "#ffffff",
        onRegionClick: function(e, code) {
          // showCountryMap(code);
        }
      });
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

    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({
            name: "campaigns.index"
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
.jvmap-smart {
  width: 600px;
  height: 400px;
}
</style>
