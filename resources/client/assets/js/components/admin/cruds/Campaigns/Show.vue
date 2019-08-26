<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <!-- <h1>Check Campaign</h1> -->
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Check Campaign</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <back-buttton></back-buttton>
            </div>
            <div class="box-body view-body">
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i> Loading
                  </div>
                </div>
              </div>
              <div v-if="!loading">
                <strong>
                  <i class="fas fa-book margin-r-5"></i> Campaign Name
                </strong>

                <p class="text-muted">{{ item.name }}</p>

                <hr>

                <strong>
                  <i class="fas fa-user-edit margin-r-5"></i> Campaign Creator
                </strong>

                <p class="text-muted">{{ item.user.name }}</p>

                <hr>

                <strong>
                  <i class="fas fa-user-tie margin-r-5"></i> SMS Sender Name
                </strong>

                <p class="text-muted">{{ item.sender_name }}</p>

                <hr>

                <strong>
                  <i class="fas fa-comment-dots margin-r-5"></i>SMS Message
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

                <hr>

                <strong>
                  <i class="fas fa-comments margin-r-5"></i>Extra Comment
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

                <hr>

                <strong>
                  <i class="fas fa-filter margin-r-5"></i> Filter
                </strong>

                <p>{{ item.filter }}</p>

                <hr>

                <strong>
                  <i class="fas fa-money-bill-wave-alt margin-r-5"></i> Price Per SMS
                </strong>

                <p>{{ item.price_per_sms + item.currency_symbol}}</p>

                <hr>

                <strong>
                  <i class="fas fa-users margin-r-5"></i> Count of Customers
                </strong>

                <p>{{ item.count_customers }}</p>

                <hr>

                <strong>
                  <i class="fas fa-money-bill margin-r-5"></i> Total Price
                </strong>

                <p>{{ item.total_price + item.currency_symbol }}</p>

                <hr>

                <strong>
                  <i class="fas fa-swatchbook margin-r-5"></i> Status
                </strong>

                <DatatableStatusRow :temp="item.status"></DatatableStatusRow>
                <hr>
                <strong>
                  <i class="fas fa-calendar-plus margin-r-5"></i> Created At
                </strong>

                <p>{{ item.local_created_at.date + ' ' + item.local_created_at.time}}</p>
                <hr>
                <strong>
                  <i class="fas fa-calendar-check margin-r-5"></i> Updated At
                </strong>
                <p>{{ item.local_updated_at.date + ' ' + item.local_updated_at.time}}</p>

                <strong>
                  <i class="fas fa-quote-right margin-r-5"></i>Reason Text
                </strong>

                <div class="form-group">
                  <textarea
                    rows="3"
                    class="form-control"
                    name="comment"
                    :value="item.reason"
                    placeholder="Enter Reason Text"
                    @input="updateReason"
                  ></textarea>
                </div>

                <hr>
              </div>
            </div>
            <div class="box-footer" v-if="item.status == 'pending'">
              <vue-button-spinner
                class="btn btn-primary btn-sm"
                :isLoading="loading"
                :disabled="loading"
                :clickFunc="btnApproveClick"
              >Approve</vue-button-spinner>
              <vue-button-spinner
                class="btn btn-danger btn-sm"
                :isLoading="loading"
                :disabled="loading"
                :clickFunc="btnRejectClick"
              >Reject</vue-button-spinner>
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
    ...mapActions("CampaignsSingle", [
      "fetchData",
      "resetState",
      "updateData",
      "setReason"
    ]),
    btnRejectClick() {
      console.log(this.item.reason);
      if (this.item.reason == null || this.item.reason == "") {
        alert("Please enter rejected reason!");
        return;
      }
      this.submitForm(false);
    },
    btnApproveClick() {
      this.submitForm(true);
    },
    updateReason(e) {
      this.setReason(e.target.value);
    },
    submitForm(flag) {
      this.updateData(flag)
        .then(() => {
          this.$router.push({
            name: "campaigns.index",
            params: {
              type: "pending"
            }
          });
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
