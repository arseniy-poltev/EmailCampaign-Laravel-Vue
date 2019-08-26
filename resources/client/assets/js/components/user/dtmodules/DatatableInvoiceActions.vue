<template>
  <div class="btn-group btn-group-xs">
    <router-link
      :to="{ name: 'campaigns.pay', params: { id: row.campaign_id } }"
      class="btn bg-purple"
    >{{ trans('backend.txt_view') }}</router-link>
  </div>
</template>


<script>
export default {
  props: ["row", "xprops"],
  data() {
    return {
      // Code...
    };
  },
  created() {
    // Code...
  },
  methods: {}
};
</script>


<style scoped>
.bg-purple {
  font-size: 14px;
}
</style>
