<template>
  <div class="btn-group btn-group-xs">
    <!-- v-if="$can(xprops.permission_prefix + 'view')" -->
    <router-link
      :to="{ name: xprops.route + '.show', params: { id: row.id } }"
      class="btn bg-purple"
    >{{ trans('backend.txt_view') }}</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'edit')" -->
    <router-link
      :to="{ name: xprops.route + '.edit', params: { id: row.id } }"
      class="btn btn-warning"
    >{{ trans('backend.txt_edit') }}</router-link>
    <!-- v-if="$can(xprops.permission_prefix + 'delete')" -->
    <button
      @click="destroyData(row.id)"
      type="button"
      class="btn btn-danger"
    >{{ trans('backend.txt_delete') }}</button>
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
        title: this.tran("backend.txt_delete_alert"),
        text: this.tran("backend.txt_delete_detail"),
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
.bg-purple {
  font-size: 14px;
}
</style>
