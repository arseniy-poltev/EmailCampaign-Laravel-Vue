<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <!-- <h1>
        Invoice
        <small>#007612</small>
      </h1>-->
    </section>

    <div class="pad margin no-print">
      <back-buttton></back-buttton>
    </div>
    <div class="row" v-if="loading">
      <div class="col-xs-4 col-xs-offset-4">
        <div class="alert text-center">
          <i class="fa fa-spin fa-refresh"></i>
          {{ trans('backend.txt_loading') }}
        </div>
      </div>
    </div>
    <section class="invoice" v-if="!loading">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i>
            {{ trans('backend.txt_site_name') }}
            <small
              class="pull-right"
            >{{ trans('backend.txt_date') }}: {{item.invoice.local_updated_at['date'] + ' ' +item.invoice.local_updated_at['time']}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info" v-if="item.invoice.status == 1">
        <div class="col-sm-4 invoice-col">
          {{ trans('backend.txt_from') }}
          <address>
            <strong>{{item.user_profile.name}}</strong>
            <br />
            {{item.user_profile.country}}
            <br />
            {{item.user_profile.address}}
            <br />
            {{ trans('backend.txt_phone') }}: {{item.user_profile.phone}}
            <br />
            {{ trans('backend.txt_email') }}: {{item.user_profile.email}}
            <br />
            {{ trans('backend.txt_vat_number') }}: {{item.user_profile.vat_number}}
          </address>
        </div>

        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{item.admin_profile.name}}</strong>
            <br />
            {{item.admin_profile.country}}
            <br />
            {{item.admin_profile.address}}
            <br />
            {{ trans('backend.txt_phone') }}: {{item.admin_profile.phone}}
            <br />
            {{ trans('backend.txt_email') }}: {{item.admin_profile.email}}
            <br />
            {{ trans('backend.txt_vat_number') }}: {{item.admin_profile.vat_number}}
          </address>
        </div>

        <div class="col-sm-4 invoice-col">
          <br />
          <br />
          <b>{{ trans('backend.txt_invoice') }} #{{item.invoice.invoice_number}}</b>
          <br />
          <br />

          <b>{{ trans('backend.txt_payment_due') }}:{{item.invoice.local_updated_at['date']}}</b>
        </div>
      </div>
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-md-6">
          <!-- <i class="fas fa-file-invoice-dollar" style="font-size: 24px;"></i>
          <span
            style="padding-left:10px;display:inline-block"
            class="lead"
          >Invoice #{{item.invoice.invoice_number}}</span>-->
          <br />

          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <th style="width:50%">{{ trans('backend.txt_initial_price') }}:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.initial_price}}</td>
                </tr>
                <tr>
                  <th>{{ trans('backend.txt_extra_price') }}:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.extra_price}}</td>
                </tr>
                <tr>
                  <th>{{ trans('backend.txt_extra_count') }}:</th>
                  <td>{{item.invoice.extra_filter_count}}</td>
                </tr>
                <tr>
                  <th style="width:50%">{{ trans('backend.txt_final_price') }}:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.initial_price+item.invoice.extra_price*item.invoice.extra_filter_count}}</td>
                </tr>
                <tr>
                  <th>{{ trans('backend.txt_number_sms') }}:</th>
                  <td>{{item.invoice.count_customers}}</td>
                </tr>
                <tr>
                  <th>{{ trans('backend.txt_total') }}:</th>
                  <td
                    class="total-price"
                  >{{item.invoice.currency_symbol}}{{item.invoice.total_price + ' ' + item.invoice.currency_code }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6" v-if="item.invoice.status == 1">
          <img src="/img/logo_paid.png" alt="Paid" class="paid-stamp" />
        </div>
        <div class="col-md-6" v-if="item.invoice.status == 0">
          <!-- <p class="lead">Payment Methods:</p> -->
          <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_1" data-toggle="tab" aria-expanded="true">
                    <!-- VISA -->
                    <img src="/img/visa.png" alt="VISA" width="70" height="20" style="padding:2px" />
                  </a>
                </li>
                <!-- <li class>
                  <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                    <img src="/img/paypal2.png" alt="Paypal" width="80" height="20">
                  </a>
                </li>-->
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="alert alert-danger alert-dismissible" v-if="stripeErrorMessage">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>
                      <i class="icon fa fa-ban"></i>
                      {{ trans('backend.txt_error') }}!
                    </h4>
                    <span>{{stripeErrorMessage}}</span>
                  </div>
                  <form @submit.prevent="onPayMethod">
                    <input name="utf8" type="hidden" value="✓" />
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="credit-card-number">{{ trans('backend.txt_card_number') }}</label>
                        <input
                          class="form-control input-credit-card"
                          id="credit-card-number"
                          type="text"
                          required
                          v-model="card.number"
                        />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="credit-card-month">{{ trans('backend.txt_month') }}</label>
                        <select id="date_month" class="form-control" v-model="exp_month">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="credit-card-year">{{ trans('backend.txt_year') }}</label>
                        <select id="date_year" class="form-control" v-model="exp_year">
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="security-code">CVC</label>
                        <input
                          class="form-control"
                          type="number"
                          id="security-code"
                          required
                          v-model="card.cvc"
                        />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="credit-card-name">{{ trans('backend.txt_name_on_card') }}</label>
                        <input
                          class="form-control"
                          id="credit-card-name"
                          type="text"
                          required
                          v-model="card.name"
                        />
                      </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-block" :disabled="payFlag">Pay</button>
                  </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">Paypal</div>
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print" v-if="item.invoice.status == 1">
        <div class="col-xs-12">
          <a
            type="button"
            class="btn btn-primary pull-right"
            style="margin-right: 5px;"
            :href="'/api/v2/invoice/' + item.invoice.id + '/generatePDF'"
          >
            <i class="fa fa-download"></i>
            {{ trans('backend.txt_generate_pdf') }}
          </a>
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
      card: {
        number: "",
        cvc: "",
        exp: "",
        name: ""
      },
      exp_month: "1",
      exp_year: "2019",
      stripeErrorMessage: null,
      stripePublishableKey: "pk_test_CjAL1lLM7cOoE5N19Xknwvx500QdoaeqPY",
      stripeCheck: false
    };
  },
  created() {
    this.fetchData(this.$route.params.id);
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("Invoice", ["item", "loading", "payFlag"])
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("Invoice", [
      "fetchData",
      "resetState",
      "stripePayment",
      "setPayFlag",
      "generatePDF"
    ]),
    onPayMethod() {
      console.log("payment!");
      //validation
      this.stripeErrorMessage = "";
      this.createToken();
    },
    createToken() {
      window.Stripe.setPublishableKey(this.stripePublishableKey);
      this.card.exp = this.exp_month + "/" + this.exp_year;
      this.setPayFlag(true);
      window.Stripe.createToken(this.card, (status, response) => {
        this.setPayFlag(false);
        if (response.error) {
          this.stripeCheck = false;
          this.stripeErrorMessage = response.error.message;
          // eslint-disable-next-line
          console.error(response);
        } else {
          console.log(response);
          var token = response;
          this.stripePayment(token.id)
            .then(result => {
              alert("Payment success!\n");
              this.$router.push({
                name: "campaigns.index"
              });
              this.$eventHub.$emit("payment-event");
            })
            .catch(error => {
              console.error(error);
              alert(error);
            });
        }
      });
    }
  }
};
</script>
<style scoped>
.paid-stamp {
  margin: 40px auto 20px;
  display: block;
}
.total-price {
  color: green;
  /* font-size: 20px; */
  font-weight: 700;
}
</style>


