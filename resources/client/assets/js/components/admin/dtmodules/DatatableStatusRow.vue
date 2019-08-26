<template>
  <div>
    <span v-if="row.activated == 1" class="label bg-green">Activated</span>
    <span v-if="row.activated == 0" class="label bg-navy">Inactived</span>
  </div>
</template>


<script>
export default {
  props: ["row", "temp", "xprops"],
  data() {
    return {
      // Code...
      spanClass: ["bg-navy", "bg-yellow", "bg-red", "bg-aqua", "bg-green"],
      statusClass: ["draft", "pending", "rejected", "approved", "done"]
    };
  },

  created() {
    // Code...
  },
  methods: {
    getClass: function(status) {
      var index = this.statusClass.indexOf(status);
      if (index != -1) {
        return this.spanClass[index];
      }
      return "bg-navy";
    }
  }
};
</script>


<style scoped>
.label {
  font-size: 14px;
}
.label-normal {
  background-color: black;
}
</style>
