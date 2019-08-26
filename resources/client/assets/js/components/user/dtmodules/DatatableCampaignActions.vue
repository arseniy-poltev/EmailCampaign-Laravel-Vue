<template>
  <div class="btn-group btn-group-xs">
    <!-- v-if="$can(xprops.permission_prefix + 'view')" -->
    <router-link
      :to="{ name: xprops.route + '.show', params: { id: row.id } }"
      class="btn btn-default"
    >View</router-link>
    <router-link
      v-if="row.status == 'approved'"
      :to="{ name: xprops.route + '.pay', params: { id: row.id } }"
      class="btn btn-default"
    >Pay</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'edit')" -->
    <router-link
      v-if="row.status == 'draft'"
      :to="{ name: xprops.route + '.edit', params: { id: row.id } }"
      class="btn btn-default"
    >Edit</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'delete')" -->
    <button
      v-if="row.status != 'pending'"
      @click="destroyData(row.id)"
      type="button"
      class="btn btn-default"
    >Delete</button>
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
