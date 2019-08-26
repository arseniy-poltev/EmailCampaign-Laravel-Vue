<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>Filter Keys</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List</h3>
            </div>
            <div class="box-body">
              <!-- <back-buttton></back-buttton> -->
              <router-link :to="{ name: 'dashboard'}" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-chevron-left"></span> Back
              </router-link>
            </div>
            <div class="box-body">
              <div class="btn-group">
                <router-link
                  v-if="$can(xprops.permission_prefix + 'create')"
                  :to="{ name: xprops.route + '.create'}"
                  class="btn btn-success btn-sm"
                >
                  <i class="fa fa-plus"></i> Add new
                </router-link>
                <button type="button" class="btn btn-default btn-sm" @click="fetchData">
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
                filterable
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
import DatatableAnswerCntColumn from "../../dtmodules/DatatableAnswerCntColumn";
import DatatableTypeColumn from "../../dtmodules/DatatableTypeColumn";

export default {
  data() {
    return {
      columns: [
        {
          title: "#",
          field: "id",
          sortable: true,
          colStyle: "width: 50px;"
        },
        {
          title: "Name",
          field: "name",
          sortable: true
        },
        {
          title: "JSON Name",
          field: "json_name",
          sortable: true
        },
        {
          title: "Type",
          field: "type",
          tdComp: DatatableTypeColumn,
          sortable: true
        },
        {
          title: "Answers",
          field: "answer_cnt",
          tdComp: DatatableAnswerCntColumn,
          sortable: true
        },
        {
          title: "Actions",
          tdComp: DatatableActions,
          visible: true,
          thClass: "text-right",
          tdClass: "text-right",
          colStyle: "width: 130px;"
        }
      ],
      query: {
        sort: "id",
        order: "desc"
      },
      xprops: {
        module: "FilterKeysIndex",
        route: "filter.keys",
        permission_prefix: "filter_key_"
      }
    };
  },
  created() {
    this.$root.relationships = this.relationships;

    this.fetchData();
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("FilterKeysIndex", [
      "data",
      "total",
      "loading",
      "relationships"
    ])
  },
  watch: {
    "$route.params": function() {
      this.fetchData();
    },
    query: {
      handler(query) {
        this.setQuery(query);
      },
      deep: true
    }
  },
  methods: {
    ...mapActions("FilterKeysIndex", ["fetchData", "setQuery", "resetState"])
  }
};
</script>

<style scoped>
</style>
