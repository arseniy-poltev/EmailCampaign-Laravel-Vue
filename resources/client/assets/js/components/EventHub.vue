<template>
  <div></div>
</template>


<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      // Code...
    };
  },
  computed: {
    ...mapGetters("Rules", ["rules"])
  },
  created() {
    this.$eventHub.$on("create-success", this.itemCreated);
    this.$eventHub.$on("update-success", this.itemUpdated);
    this.$eventHub.$on("delete-success", this.itemDeleted);
    this.$eventHub.$on("rules-update", this.rulesUpdate);
    this.$eventHub.$on("custome-event", this.customeEvent);
    this.$eventHub.$on("payment-event", this.itemPaid);
  },
  methods: {
    itemCreated() {
      this.$awn.success("Your item has been successfully saved.");
    },
    itemPaid() {
      this.$awn.info("Your item has been successfully paid.");
    },
    itemUpdated() {
      this.$awn.success("Your item has been successfully updated.");
    },
    itemDeleted() {
      this.$awn.success("Your item has been successfully deleted.");
    },
    rulesUpdate() {
      this.$ability.update([{ subject: "all", actions: this.rules }]);
    },
    customeEvent(param) {
      this.$awn.options.labels = {
        info: "New Notification"
      };
      this.$awn.info(param);
    }
  }
};
</script>


<style scoped>
</style>
