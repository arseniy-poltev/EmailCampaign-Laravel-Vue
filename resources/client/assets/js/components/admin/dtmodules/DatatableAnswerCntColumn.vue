<template>
  <div>
    <router-link
      v-if="row.type == 0"
      :to="{ name: 'key.answers.index', params: { id: row.id } }"
      class="btn btn-success"
    >{{row.answer_cnt}} Answers</router-link>
    <span v-if="row.type == 1">*</span>
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
