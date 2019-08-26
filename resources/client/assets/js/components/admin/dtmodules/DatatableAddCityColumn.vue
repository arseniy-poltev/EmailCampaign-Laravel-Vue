<template>
  <div>
    <router-link
      v-if="$can(xprops.permission_prefix + 'view')"
      :to="{ name: 'cities.index', params: { id: row.id } }"
      class="btn btn-danger"
    >{{row.city_cnt}} Cities</router-link>
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
