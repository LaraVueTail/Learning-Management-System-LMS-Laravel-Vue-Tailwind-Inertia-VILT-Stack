<template>
  <div v-if="errors ?? false">
    <div
      v-for="(value, key, index) in errors"
      :key="index"
      v-text="value"
      class="text-red-600 text-sm mt-1 bg-red-200 p-2 rounded m-2"
    ></div>
  </div>
</template>
<script>
export default {
  props: ["errors"],
};
</script>
