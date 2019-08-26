<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>SMS campaigns({{type}})</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="campaign-category" @click="fetchData('all')">
            <div class="info-box bg-blue">
              <span class="info-box-icon">
                <i class="fas fa-comment-dots"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">All</span>
                <span class="info-box-number">{{summary['totalCnt']}}</span>

                <span class="progress-description">You have {{summary.totalCnt}} campaigns</span>
              </div>
            </div>
          </div>
          <div class="campaign-category" @click="fetchData('pending')">
            <div class="info-box bg-yellow">
              <span class="info-box-icon">
                <i class="fa fa-calendar"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Pending</span>
                <span class="info-box-number">{{summary.pendingCnt}}</span>

                <span
                  class="progress-description"
                >Your {{summary.pendingCnt}} campaigns are pending now</span>
              </div>
            </div>
          </div>
          <div class="campaign-category" @click="fetchData('rejected')">
            <div class="info-box bg-red">
              <span class="info-box-icon">
                <i class="fas fa-warning"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Rejected</span>
                <span class="info-box-number">{{summary.rejectedCnt}}</span>

                <span
                  class="progress-description"
                >Your {{summary.rejectedCnt}} campaigns are rejected</span>
              </div>
            </div>
          </div>
          <div class="campaign-category" @click="fetchData('approved')">
            <div class="info-box bg-aqua">
              <span class="info-box-icon">
                <i class="fas fa-award"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Approved</span>
                <span class="info-box-number">{{summary.approvedCnt}}</span>

                <span
                  class="progress-description"
                >Your {{summary.approvedCnt}} campaigns are approved</span>
              </div>
            </div>
          </div>
          <div class="campaign-category" @click="fetchData('done')">
            <div class="info-box bg-green">
              <span class="info-box-icon">
                <i class="fas fa-heart" style="font-size: 48px;"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Done</span>
                <span class="info-box-number">{{summary.doneCnt}}</span>

                <span class="progress-description">Your {{summary.doneCnt}} campaigns are done</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">List</h3>
            </div>

            <div class="box-body">
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" @click="fetchData(type)">
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
                :supportBackup="true"
                tblClass="table-bordered"
                tblStyle="color: #666"
                :pageSizeOption="[5, 10, 15, 20]"
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
      <div class="row"></div>
      <div class="row">
        <div class="col-xs-12"></div>
      </div>
    </section>
  </section>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import DatatableCampaignActions from "../../dtmodules/DatatableCustomeActions";
import DatatableStatusRow from "../../../DatatableStatusRow";
import DatatableSingle from "../../dtmodules/DatatableSingle";
import DatatableList from "../../dtmodules/DatatableList";
import DatatableCheckbox from "../../dtmodules/DatatableCheckbox";
import TimeShowVue from "../../../TimeShow.vue";

export default {
  data() {
    return {
      supportBackup: true,
      supportNested: true,
      tblClass: "table-bordered",
      tblStyle: "color: #666",
      pageSizeOptions: [5, 10, 15, 20],
      columns: [
        { title: "#", field: "id", sortable: true, colStyle: "width: 50px;" },
        {
          title: "Campaign Name",
          field: "name",
          sortable: true,
          // thComp: DatatableFilter,
          thStyle: { fontWeight: "normal" }
        },

        { title: "Sender Name", field: "sender_name", sortable: true },
        {
          title: "Status",
          field: "status",
          sortable: true,
          tdComp: DatatableStatusRow
        },

        {
          title: "Updated",
          field: "local_updated_at",
          sortable: true,
          tdComp: TimeShowVue
        },
        {
          title: "Created",
          field: "local_created_at",
          tdComp: TimeShowVue,
          sortable: true
        },
        {
          title: "Actions",
          tdComp: DatatableCampaignActions,
          visible: true,
          thClass: "text-right",
          tdClass: "text-right",
          colStyle: "width: 130px;"
        }
      ],
      // query: { sort: "id", order: "desc" },
      query: {},
      xprops: {
        module: "CampaignsIndex",
        route: "campaigns",
        permission_prefix: "campaign_"
      }
    };
  },
  created() {
    this.$root.relationships = this.relationships;
    this.fetchSummary();
    this.fetchData(this.type);
  },
  mounted() {
    this.$store.dispatch("SideBar/updateData", this.countMsg);
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("CampaignsIndex", [
      "data",
      "total",
      "type",
      "summary",
      "loading",
      "relationships"
    ])
  },
  watch: {
    query: {
      handler(query) {
        this.setQuery(query);
      },
      deep: true
    }
  },
  methods: {
    ...mapActions("CampaignsIndex", [
      "fetchData",
      "fetchSummary",
      "setQuery",
      "resetState"
    ])
  }
};
</script>


<style scoped>
.campaign-category {
  cursor: pointer;
  padding-bottom: 20px;
}
.campaign-header {
  cursor: pointer;
}
.info-box-number {
  font-size: 28px !important;
}
</style>
