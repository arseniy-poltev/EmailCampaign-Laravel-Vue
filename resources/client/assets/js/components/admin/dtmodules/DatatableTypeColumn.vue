<template>
  <div>
    <span>{{ row.type == 0 ? "Normal" : "Range" }}</span>
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
  }
};
</script>
