<template>
  <div>
    <span v-if="row" class="label" v-bind:class="getClass(row.status)">{{row.status}}</span>
    <span v-if="temp" class="label" v-bind:class="getClass(temp)">{{temp}}</span>
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
