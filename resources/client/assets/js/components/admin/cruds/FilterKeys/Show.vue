<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Filter Key</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">View</h3>
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
              <div class="row" v-if="!loading">
                <div class="col-xs-6">
                  <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                        <th>#</th>
                        <td>{{ item.id }}</td>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <td>{{ item.name }}</td>
                      </tr>
                      <tr>
                        <th>JSON Name</th>
                        <td>{{ item.json_name }}</td>
                      </tr>
                      <tr>
                        <th>Type</th>
                        <td>{{ item.type == 0 ? "Normal" : "Range" }}</td>
                      </tr>

                      <tr v-if="item.type == 1">
                        <th>Min Value</th>
                        <td>{{item.min_value}}</td>
                      </tr>
                      <tr v-if="item.type == 1">
                        <th>Max Value</th>
                        <td>{{item.max_value}}</td>
                      </tr>
                      <tr v-if="item.type == 1">
                        <th>Step Value</th>
                        <td>{{item.step}}</td>
                      </tr>

                      <tr>
                        <th>Answers</th>
                        <td>
                          <router-link
                            v-if="$can('key_answer_view')"
                            :to="{ name: 'key.answers.index', params: { id: item.id } }"
                            class="btn btn-warning"
                          >{{item.answer_cnt}} Answers</router-link>
                        </td>
                      </tr>
                      <tr>
                        <th>Created At</th>
                        <td>{{ item.created_at }}</td>
                      </tr>
                      <tr>
                        <th>Updated At</th>
                        <td>{{ item.updated_at }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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

export default {
  data() {
    return {
      // Code...
    };
  },
  created() {
    this.fetchData(this.$route.params.id);
    this.fetchLanguageData();
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("FilterKeysSingle", [
      "item",
      "loading",
      "languages",
      "locale"
    ])
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
      this.fetchLanguageData();
    }
  },
  methods: {
    ...mapActions("FilterKeysSingle", [
      "fetchData",
      "resetState",
      "setLocale",
      "fetchLanguageData"
    ]),
    updateLocale(e) {
      this.setLocale(e.target.value);
      this.fetchData(this.$route.params.id);
    }
  }
};
</script>
