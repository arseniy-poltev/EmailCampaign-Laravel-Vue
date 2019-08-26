<template>
  <div class="btn-group btn-group-xs">
    <!-- v-if="$can(xprops.permission_prefix + 'view')" -->
    <router-link
      :to="{ name: xprops.route + '.show', params: { id: row.id } }"
      class="btn bg-purple"
    >View</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'edit')" -->
    <router-link
      :to="{ name: xprops.route + '.edit', params: { id: row.id } }"
      class="btn btn-warning"
    >Edit</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'delete')" -->
    <button @click="destroyData(row.id)" type="button" class="btn btn-danger">Delete</button>
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
  methods: {
    destroyData(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "#dd4b39",
        focusCancel: true,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          this.$store
            .dispatch(this.xprops.module + "/destroyData", id)
            .then(result => {
              this.$eventHub.$emit("delete-success");
            });
        }
      });
    }
  }
};
</script>


<style scoped>
</style>
