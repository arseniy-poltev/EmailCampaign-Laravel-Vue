<template>
  <div class="btn-group btn-group-xs">
    <router-link :to="{ name: 'invoices.show', params: { id: row.id } }" class="btn bg-purple">View</router-link>
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
