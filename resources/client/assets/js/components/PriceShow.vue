<template>
  <div>
    <span>{{row['currency_symbol'] + row[field]}}</span>
    <!-- <span>({{row[field]['for_human']}})</span> -->
  </div>
</template>
<script>
export default {
  props: ["row", "xprops", "field"]
};
</script>

