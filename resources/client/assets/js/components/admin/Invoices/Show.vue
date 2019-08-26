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
          <i class="fa fa-spin fa-refresh"></i> Loading
        </div>
      </div>
    </div>
    <section class="invoice" v-if="!loading">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Targetcustomer.net
            <small
              class="pull-right"
            >Date: {{item.invoice.local_updated_at['date'] + ' ' +item.invoice.local_updated_at['time']}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{item.user_profile.name}}</strong>
            <br />
            {{item.user_profile.country}}
            <br />
            {{item.user_profile.address}}
            <br />
            Phone: {{item.user_profile.phone}}
            <br />
            Email: {{item.user_profile.email}}
            <br />
            VAT Number: {{item.user_profile.vat_number}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{item.admin_profile.name}}</strong>
            <br />
            {{item.admin_profile.country}}
            <br />
            {{item.admin_profile.address}}
            <br />
            Phone: {{item.admin_profile.phone}}
            <br />
            Email: {{item.admin_profile.email}}
            <br />
            VAT Number: {{item.admin_profile.vat_number}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <br />
          <br />
          <b>Invoice #{{item.invoice.invoice_number}}</b>
          <br />
          <br />
          <!-- <b>Order ID:</b> 4F3S8J -->
          <!-- <br /> -->
          <b>Payment Due:{{item.invoice.local_updated_at['date']}}</b>
          <!-- <br />
          <b>Account:</b> 968-34567-->
        </div>
        <!-- /.col -->
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
                  <th style="width:50%">Initial Price per SMS:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.initial_price}}</td>
                </tr>
                <tr>
                  <th>Extra Price per filter:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.extra_price}}</td>
                </tr>
                <tr>
                  <th>Extra Filter Count:</th>
                  <td>{{item.invoice.extra_filter_count}}</td>
                </tr>
                <tr>
                  <th style="width:50%">Final Price per SMS:</th>
                  <td>{{item.invoice.currency_symbol}}{{item.invoice.initial_price+item.invoice.extra_price*item.invoice.extra_filter_count}}</td>
                </tr>
                <tr>
                  <th>Number of SMS:</th>
                  <td>{{item.invoice.count_customers}}</td>
                </tr>
                <tr>
                  <th>Total:</th>
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
            :href="'/api/v1/invoice/' + item.invoice.id + '/generatePDF'"
          >
            <i class="fa fa-download"></i> Generate PDF
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
    return {};
  },
  created() {
    this.fetchData(this.$route.params.id);
  },
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters("InvoicesSingle", ["item", "loading"])
  },
  watch: {
    "$route.params.id": function() {
      this.resetState();
      this.fetchData(this.$route.params.id);
    }
  },
  methods: {
    ...mapActions("InvoicesSingle", ["fetchData", "resetState"])
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


