<template>
  <div>
    <span class="paid" v-if="row.status == 1">{{ trans('backend.txt_paid') }}</span>
    <span class="unpaid" v-if="row.status == 0">{{ trans('backend.txt_pending') }}</span>
    <!-- <span>({{row[field]['for_human']}})</span> -->
  </div>
</template>
<script>
export default {
  props: ["row", "xprops", "field"]
};
</script>
<style scoped>
.paid {
  color: green;
}
.unpaid {
  color: black;
}
</style>


