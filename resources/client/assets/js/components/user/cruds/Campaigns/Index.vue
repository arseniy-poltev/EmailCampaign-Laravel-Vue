<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <!-- <h1>{{ trans('backend.txt_invoice') }}({{type}})</h1> -->
      <h1>{{ trans('backend.txt_SMS_campaign') }}</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('draft')">
          <div class="info-box bg-navy">
            <span class="info-box-icon">
              <i class="fas fa-drafting-compass"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_draft') }}</span>
              <span class="info-box-number">{{summary.draftCnt}}</span>

              <span
                class="progress-description"
              >{{ parse(trans('backend.txt_draft_desc'), summary.draftCnt) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('pending')">
          <div class="info-box bg-yellow">
            <span class="info-box-icon">
              <i class="fa fa-calendar"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_pending') }}</span>
              <span class="info-box-number">{{summary.pendingCnt}}</span>

              <span
                class="progress-description"
              >{{ parse(trans('backend.txt_pending_desc'), summary.pendingCnt) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('rejected')">
          <div class="info-box bg-red">
            <span class="info-box-icon">
              <i class="fas fa-warning"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_rejected') }}</span>
              <span class="info-box-number">{{summary.rejectedCnt}}</span>

              <span
                class="progress-description"
              >{{ parse(trans('backend.txt_rejected_desc'), summary.rejectedCnt) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('approved')">
          <div class="info-box bg-aqua">
            <span class="info-box-icon">
              <i class="fas fa-award"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_approved') }}</span>
              <span class="info-box-number">{{summary.approvedCnt}}</span>

              <span
                class="progress-description"
              >{{ parse(trans('backend.txt_approved_desc'), summary.approvedCnt) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('done')">
          <div class="info-box bg-green">
            <span class="info-box-icon">
              <i class="fas fa-heart" style="font-size: 48px;"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_done') }}</span>
              <span class="info-box-number">{{summary.doneCnt}}</span>

              <span
                class="progress-description"
              >{{ parse(trans('backend.txt_done_desc'), summary.doneCnt) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 campaign-category" @click="fetchData('all')">
          <div class="info-box bg-blue">
            <span class="info-box-icon">
              <i class="fas fa-comment-dots"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">{{ trans('backend.txt_all') }}</span>
              <span class="info-box-number">{{summary['totalCnt']}}</span>

              <span class="progress-description">You have {{summary.totalCnt}} campaigns</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('backend.txt_list') }}</h3>
            </div>

            <div class="box-body">
              <div class="btn-group">
                <!-- v-if="$can(xprops.permission_prefix + 'create')" -->
                <router-link
                  :to="{ name: xprops.route + '.filter' }"
                  class="btn btn-success btn-sm"
                >
                  <i class="fa fa-plus"></i>
                  {{ trans('backend.txt_add_new') }}
                </router-link>

                <button type="button" class="btn btn-default btn-sm" @click="fetchData(type)">
                  <i class="fa fa-refresh" :class="{'fa-spin': loading}"></i>
                  {{ trans('backend.txt_refresh') }}
                </button>
              </div>
            </div>

            <div class="box-body">
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i>
                    {{ trans('backend.txt_loading') }}
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
    </section>
  </section>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import DatatableCampaignActions from "../../dtmodules/DatatableCampaignActions";
import DatatableStatusRow from "../../../DatatableStatusRow";
import DatatableSingle from "../../dtmodules/DatatableSingle";
import DatatableList from "../../dtmodules/DatatableList";
import DatatableCheckbox from "../../dtmodules/DatatableCheckbox";
import DatatableFilter from "../../dtmodules/DatatableFilter";
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
          title: this.trans("backend.txt_campaign_name"),
          field: "name",
          sortable: true
          // thComp: DatatableFilter,
          // thStyle: { fontWeight: "normal" }
        },
        {
          title: this.trans("backend.txt_sender_name"),
          field: "sender_name",
          sortable: true
        },
        {
          title: this.trans("backend.txt_status"),
          field: "status",
          sortable: true,
          tdComp: DatatableStatusRow
        },

        {
          title: this.trans("backend.txt_updated"),
          field: "local_updated_at",
          sortable: true,
          tdComp: TimeShowVue
        },
        {
          title: this.trans("backend.txt_created"),
          field: "local_created_at",
          tdComp: TimeShowVue,
          sortable: true
        },
        {
          title: this.trans("backend.txt_actions"),
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
  destroyed() {
    this.resetState();
  },
  mounted() {
    this.$store.dispatch("SideBar/updateData", this.countMsg);
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
    ]),
    parse(str) {
      var args = [].slice.call(arguments, 1),
        i = 0;
      return str.replace(/%d/g, () => args[i++]);
    }
  }
};
</script>


<style scoped>
.campaign-category {
  cursor: pointer;
}
.campaign-header {
  cursor: pointer;
}
.info-box-number {
  font-size: 28px !important;
}
</style>
