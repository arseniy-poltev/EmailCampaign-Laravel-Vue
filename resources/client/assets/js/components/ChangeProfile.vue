<template>
  <section class="content-wrapper" style="min-height: 960px;">
    <section class="content-header">
      <h1>{{ trans('backend.txt_change_profile') }}</h1>
    </section>

    <section class="content">
      <div class="row">
        <form @submit.prevent="submitForm">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border box-success">
                <h3 class="box-title">{{ trans('backend.txt_change_profile') }}</h3>
              </div>

              <div class="box-body">
                <back-buttton></back-buttton>
              </div>

              <bootstrap-alert />
              <div class="row" v-if="loading">
                <div class="col-xs-4 col-xs-offset-4">
                  <div class="alert text-center">
                    <i class="fa fa-spin fa-refresh"></i>
                    {{ trans('backend.txt_loading') }}
                  </div>
                </div>
              </div>
              <div class="box-body" v-if="!loading">
                <div class="form-group">
                  <label for="name">{{ trans('backend.txt_company_name') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    :value="item.name"
                    @input="updateName"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="email">{{ trans('backend.txt_email') }}</label>
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    :value="item.email"
                    @input="updateEmail"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="phone">{{ trans('backend.txt_phone_number') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    name="phone"
                    :value="item.phone"
                    @input="updatePhone"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="country">{{ trans('backend.txt_country') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    name="country"
                    :value="item.country"
                    @input="updateCountry"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="address">{{ trans('backend.txt_address') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    name="address"
                    :value="item.address"
                    @input="updateAddress"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="vat_number">{{ trans('backend.txt_vat_number') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    name="vat_number"
                    :value="item.vat_number"
                    @input="updateVATNumber"
                    required
                  />
                </div>
              </div>

              <div class="box-footer">
                <vue-button-spinner
                  class="btn btn-primary btn-sm"
                  :isLoading="loading"
                  :disabled="loading"
                >{{ trans('backend.txt_save') }}</vue-button-spinner>
              </div>
            </div>
          </div>
        </form>
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
  computed: {
    ...mapGetters("ChangeProfile", ["item", "loading"])
  },
  created() {
    // Code...
    this.fetchData();
  },
  destroyed() {
    this.resetState();
  },
  methods: {
    ...mapActions("ChangeProfile", [
      "storeData",
      "fetchData",
      "resetState",
      "setName",
      "setEmail",
      "setPhone",
      "setCountry",
      "setAddress",
      "setVATNumber"
    ]),
    updateName(e) {
      this.setName(e.target.value);
    },
    updateEmail(e) {
      this.setEmail(e.target.value);
    },
    updatePhone(e) {
      this.setPhone(e.target.value);
    },
    updateCountry(e) {
      this.setCountry(e.target.value);
    },
    updateAddress(e) {
      this.setAddress(e.target.value);
    },
    updateVATNumber(e) {
      this.setVATNumber(e.target.value);
    },
    submitForm() {
      this.storeData()
        .then(() => {
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
</style>
