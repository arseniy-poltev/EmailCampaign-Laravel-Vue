<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>
        {{ trans('backend.txt_invoice') }}
        <!-- <small>Version 2.0</small> -->
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">List</h3>
            </div>

            <div class="box-body">
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" @click="fetchData">
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
import TimeShowVue from "../TimeShow.vue";
import PriceShowVue from "../PriceShow.vue";
import DatatableInvoiceActions from "./dtmodules/DatatableInvoiceActions";
import InvoiceStatusShowVue from "../InvoiceStatusShow.vue";

export default {
  data() {
    return {
      supportBackup: true,
      supportNested: true,
      tblClass: "table-bordered",
      tblStyle: "color: #666",
      pageSizeOptions: [5, 10, 15, 20],
      columns: [
        {
          title: "#",
          field: "invoice_number",
          sortable: true,
          colStyle: "width: 150px;"
        },
        {
          title: this.trans("backend.txt_campaign_name"),
          field: "campaign_name",
          sortable: true,
          thStyle: { fontWeight: "normal" }
        },
        {
          title: this.trans("backend.txt_amount"),
          field: "total_price",
          sortable: true,
          tdComp: PriceShowVue,
          thStyle: { fontWeight: "normal" }
        },
        {
          title: this.trans("backend.txt_currency"),
          field: "currency_code",
          sortable: true,
          thStyle: { fontWeight: "normal" }
        },
        // {
        //   title: this.trans("backend.txt_status"),
        //   field: "status",
        //   sortable: true,
        //   tdComp: InvoiceStatusShowVue,
        //   thStyle: { fontWeight: "normal" }
        // },
        {
          title: this.trans("backend.txt_updated"),
          field: "local_updated_at",
          sortable: true,
          tdComp: TimeShowVue,
          thStyle: { fontWeight: "normal" }
        },
        {
          title: this.trans("backend.txt_actions"),
          tdComp: DatatableInvoiceActions,
          visible: true,
          thClass: "text-right",
          tdClass: "text-right",
          colStyle: "width: 130px;"
        }
      ],
      // query: { sort: "id", order: "desc" },
      query: {},
      xprops: {
        module: "InvoicesIndex",
        route: "invoices",
        permission_prefix: "invoice_"
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
  mounted() {},
  computed: {
    ...mapGetters("InvoicesIndex", [
      "data",
      "total",
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
    ...mapActions("InvoicesIndex", ["fetchData", "setQuery", "resetState"])
  }
};
</script>


