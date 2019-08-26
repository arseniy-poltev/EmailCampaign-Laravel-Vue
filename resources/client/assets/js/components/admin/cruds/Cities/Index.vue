<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>City</h1>
    </section>

    <section class="content">
      <div class="panel panel-success" v-if="!loading">
        <div class="panel-heading">Coutry</div>
        <div class="panel-body">
          <!-- <router-link :to="{ name: 'tests.index' ,  params: { id: testinfo.id }}"> -->
          <h2>{{countryInfo.name}}</h2>
          <country-flag :country="countryInfo.code" size="big" class="flag-icon" />
          <!-- </router-link> -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List</h3>
            </div>
            <div class="box-body">
              <router-link :to="{ name: 'countries.index'}" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-chevron-left"></span> Back
              </router-link>
            </div>
            <div class="box-body">
              <div class="btn-group">
                <router-link
                  v-if="!loading"
                  :to="{ name: xprops.route + '.create', params: { id: countryId,code:countryInfo.code }}"
                  class="btn btn-success btn-sm"
                >
                  <i class="fa fa-plus"></i> Add new
                </router-link>

                <button type="button" class="btn btn-default btn-sm" @click="fetchData(countryId)">
                  <i class="fa fa-refresh" :class="{'fa-spin': loading}"></i> Refresh
                </button>
              </div>
            </div>

            <div class="box-body">
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i> Loading
                  </div>
                </div>
              </div>

              <datatable
                v-if="!loading"
                :columns="columns"
                :data="data"
                :total="total"
                :query="query"
                :xprops="xprops"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import DatatableActions from "../../dtmodules/DatatableActions";
import DatatableSingle from "../../dtmodules/DatatableSingle";
import DatatableList from "../../dtmodules/DatatableList";
import DatatableCheckbox from "../../dtmodules/DatatableCheckbox";

export default {
  data() {
    return {
      columns: [
        { title: "Name", field: "name", sortable: true },
        { title: "Postal Code", field: "postal_code", sortable: true },
        {
          title: "Actions",
          tdComp: DatatableActions,
          visible: true,
          thClass: "text-right",
          tdClass: "text-right",
          colStyle: "width: 130px;"
        }
      ],
      query: { sort: "id", order: "desc" },
      xprops: {
        module: "CitiesIndex",
        route: "cities",
        permission_prefix: "city_"
      },
      countryId: this.$route.params.id
    };
  },

  created() {
    this.$root.relationships = this.relationships;
    this.fetchData(this.countryId);
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("CitiesIndex", [
      "data",
      "countryInfo",
      "total",
      "loading",
      "relationships"
    ])
  },
  watch: {
    "$route.params": function() {
      this.fetchData(this.$route.params.id);
    },
    query: {
      handler(query) {
        this.setQuery(query);
      },
      deep: true
    }
  },
  methods: {
    ...mapActions("CitiesIndex", ["fetchData", "setQuery", "resetState"])
  }
};
</script>


<style scoped>
</style>
