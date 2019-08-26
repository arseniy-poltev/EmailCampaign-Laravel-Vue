<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>City</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">View</h3>
            </div>

            <div class="box-body">
              <back-buttton></back-buttton>
            </div>

            <div class="box-body">
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
                        <th>{{item.country_name}}</th>
                        <td>
                          <country-flag :country="item.country_code" size="big" class="flag-icon" />
                        </td>
                      </tr>
                      <tr>
                        <th>City Name</th>
                        <td>{{ item.name }}</td>
                      </tr>
                      <tr>
                        <th>Postal Code</th>
                        <td>{{ item.postal_code }}</td>
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
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("CitiesSingle", ["item", "loading"])
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("CitiesSingle", ["fetchData", "resetState"])
  }
};
</script>

<style scoped>
</style>
