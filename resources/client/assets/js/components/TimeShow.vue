<template>
  <div>
    <span>{{row[field]['date'] + ' ' + row[field]['time']}}</span>
    <!-- <span>({{row[field]['for_human']}})</span> -->
  </div>
</template>
<script>
export default {
  props: ["row", "xprops", "field"]
};
</script>

