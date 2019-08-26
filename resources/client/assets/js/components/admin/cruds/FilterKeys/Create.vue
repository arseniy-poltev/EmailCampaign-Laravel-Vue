<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Filter Key</h1>
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
                <!-- <back-buttton></back-buttton> -->
                <router-link
                  v-if="$can('filter_key_access')"
                  :to="{ name: 'filter.keys.index'}"
                  class="btn btn-default btn-sm"
                >
                  <span class="glyphicon glyphicon-chevron-left"></span> Back to All
                </router-link>
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
                  <label for="name">Filter Key Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Enter Name *"
                    :value="item.name"
                    @input="updateName"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="jsonName">JSON Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="jsonName"
                    placeholder="Enter JSON Name *"
                    :value="item.json_name"
                    @input="updateJSONName"
                    required
                  />
                </div>
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="sel1">Select Key Type:</label>
                    <select class="form-control" name="type" required @input="updateType">
                      <option value="0">Normal</option>
                      <option value="1">Range</option>
                    </select>
                  </div>
                </div>
                <div v-if="item.type == 1">
                  <div class="form-group">
                    <label for="min_value">Min Value</label>
                    <input
                      type="number"
                      class="form-control"
                      name="min_value"
                      placeholder="Enter Min Value *"
                      :value="item.min_value"
                      @input="updateMinValue"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="max_value">Max Value</label>
                    <input
                      type="number"
                      class="form-control"
                      name="max_value"
                      placeholder="Enter Max Value *"
                      :value="item.max_value"
                      @input="updateMaxValue"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="step">Step Value</label>
                    <input
                      type="number"
                      class="form-control"
                      name="step"
                      placeholder="Enter Step Value *"
                      :value="item.step"
                      @input="updateStep"
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

export default {
  data() {
    return {
      // Code...
    };
  },
  created() {
    // Code ...
    this.init();
  },
  computed: {
    ...mapGetters("FilterKeysSingle", ["item", "loading"])
  },
  watch: {},
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("FilterKeysSingle", [
      "storeData",
      "resetState",
      "setName",
      "setJSONName",
      "setType",
      "setMinValue",
      "setMaxValue",
      "setStep"
    ]),
    init() {
      this.resetState();
    },

    updateName(e) {
      this.setName(e.target.value);
    },
    updateJSONName(e) {
      this.setJSONName(e.target.value);
    },
    updateType(e) {
      this.setType(e.target.value);
    },
    updateMinValue(e) {
      this.setMinValue(e.target.value);
    },
    updateMaxValue(e) {
      this.setMaxValue(e.target.value);
    },
    updateStep(e) {
      this.setStep(e.target.value);
    },
    submitForm() {
      this.storeData()
        .then(result => {
          this.$router.push({
            name: "filter.keys.index"
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
