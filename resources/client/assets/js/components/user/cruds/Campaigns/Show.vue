<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>{{ trans('backend.txt_campaign') }}</h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('backend.txt_check_campaign') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <back-buttton></back-buttton>
            </div>
            <div class="box-body view-body">
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i>
                    {{ trans('backend.txt_loading') }}
                  </div>
                </div>
              </div>
              <div v-if="!loading">
                <strong>
                  <i class="fas fa-book margin-r-5"></i>
                  {{ trans('backend.txt_campaign_name') }}
                </strong>

                <p class="text-muted">{{ item.name }}</p>

                <hr />

                <strong>
                  <i class="fas fa-user-tie margin-r-5"></i>
                  {{ trans('backend.txt_sender_name') }}
                </strong>

                <p class="text-muted">{{ item.sender_name }}</p>

                <hr />

                <strong>
                  <i class="fas fa-comment-alt margin-r-5"></i>
                  {{ trans('backend.txt_sms_message') }}
                </strong>

                <div class="form-group">
                  <textarea
                    rows="9"
                    class="form-control"
                    name="message"
                    placeholder="Enter SMS Message"
                    :value="item.message"
                    disabled
                  ></textarea>
                </div>

                <hr />

                <strong>
                  <i class="fas fa-comments margin-r-5"></i>
                  {{ trans('backend.txt_extra_comment') }}
                </strong>

                <div class="form-group">
                  <textarea
                    rows="3"
                    class="form-control"
                    name="comment"
                    :value="item.comment"
                    disabled
                  ></textarea>
                </div>

                <hr />

                <strong>
                  <i class="fas fa-filter margin-r-5"></i>
                  {{ trans('backend.txt_filter') }}
                </strong>

                <p>{{ item.filter }}</p>

                <hr />
                <strong>
                  <i class="fas fa-money-bill-wave-alt margin-r-5"></i>
                  {{ trans('backend.txt_price_per_sms') }}
                </strong>

                <p>{{ item.price_per_sms + item.currency_symbol}}</p>

                <hr />

                <strong>
                  <i class="fas fa-users margin-r-5"></i>
                  {{ trans('backend.txt_count_customer') }}
                </strong>

                <p>{{ item.count_customers }}</p>

                <hr />

                <strong>
                  <i class="fas fa-money-bill margin-r-5"></i>
                  {{ trans('backend.txt_total_price') }}
                </strong>

                <p>{{ item.total_price + item.currency_symbol }}</p>

                <hr />

                <strong>
                  <i class="fas fa-swatchbook margin-r-5"></i>
                  {{ trans('backend.txt_status') }}
                </strong>

                <DatatableStatusRow :temp="item.status"></DatatableStatusRow>
                <hr />

                <div v-if="item.status == 'rejected'">
                  <strong>
                    <i class="fas fa-quote-right margin-r-5"></i>
                    {{ trans('backend.txt_why_reject') }}
                  </strong>

                  <div class="form-group">
                    <textarea
                      rows="3"
                      class="form-control"
                      name="comment"
                      :value="item.reason"
                      disabled
                    ></textarea>
                  </div>

                  <hr />
                </div>
                <strong>
                  <i class="fas fa-calendar-plus margin-r-5"></i>
                  {{ trans('backend.txt_created') }}
                </strong>

                <p>{{ item.local_created_at.date + ' ' + item.local_created_at.time}}</p>
                <hr />
                <strong>
                  <i class="fas fa-calendar-check margin-r-5"></i>
                  {{ trans('backend.txt_updated') }}
                </strong>
                <p>{{ item.local_updated_at.date + ' ' + item.local_updated_at.time}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import DatatableStatusRow from "../../../DatatableStatusRow";
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
  components: {
    DatatableStatusRow
  },
  computed: {
    ...mapGetters("CampaignsSingle", ["item", "loading"])
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("CampaignsSingle", ["fetchData", "resetState"])
  }
};
</script>

<style scoped>
.fas {
  font-size: 20px;
}
strong {
  font-size: 16px;
  font-weight: 500 !important;
}
p {
  font-size: 20px;
}
.view-body {
  padding: 24px !important;
}
</style>
