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
                <h3 class="box-title">Edit</h3>
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

              <div class="box-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="locale">Select Language:</label>
                    <select
                      class="form-control"
                      name="locale"
                      required
                      :value="locale"
                      @input="updateLocale"
                    >
                      <option
                        v-for="language in languages"
                        v-bind:key="language.id"
                        :value="language.locale"
                      >{{language.language}}</option>
                    </select>
                  </div>
                </div>
                <div class="row" v-if="loading">
                  <div class="col-xs-4 col-xs-offset-4">
                    <div class="alert text-center">
                      <i class="fa fa-spin fa-refresh"></i> Loading
                    </div>
                  </div>
                </div>
                <div class v-if="!loading">
                  <div class="form-group">
                    <label for="name">Filter Key Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      placeholder="Enter Name *"
                      :value="item.name"
                      @input="updateName"
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
                      <select
                        class="form-control"
                        name="type"
                        :value="item.type"
                        required
                        @input="updateType"
                      >
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
    ...mapGetters("FilterKeysSingle", [
      "item",
      "loading",
      "languages",
      "locale"
    ])
  },
  created() {
    this.init();
  },
  destroyed() {
    this.resetState();
  },
  watch: {
    "$route.params.id": function() {
      this.init();
    }
  },
  methods: {
    ...mapActions("FilterKeysSingle", [
      "fetchData",
      "fetchLanguageData",
      "updateData",
      "resetState",
      "setName",
      "setJSONName",
      "setType",
      "setMinValue",
      "setMaxValue",
      "setStep",
      "setLocale"
    ]),
    init() {
      this.resetState();
      this.fetchData(this.$route.params.id)
        .then(() => {})
        .catch(error => {
          console.error(error);
        });
      this.fetchLanguageData();
    },
    updateLocale(e) {
      this.setLocale(e.target.value);
      this.fetchData(this.$route.params.id);
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
      this.updateData()
        .then(() => {
          // this.$router.push({
          //   name: "factors.index",
          //   params: {
          //     id: this.item.test_id
          //   }
          // });
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
