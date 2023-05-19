<template>
  <div class="mb-2">
    <div class="flex items-center">
      <input
        :checked="checked"
        :id="name"
        :value="readOnly ?? modelValue"
        :disabled="disabled"
        @change="$emit('update:modelValue', $event.target.checked)"
        :class="{
          'border-2 border-rose-500': error,
          'cursor-not-allowed': disabled,
        }"
        type="checkbox"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
      />
      <label
        :for="name"
        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >{{ label }}</label
      >
    </div>
    <div v-if="error" v-text="error" class="text-red-500 text-xs mt-1"></div>
  </div>
</template>
<script>
export default {
  props: ["label", "modelValue", "error", "name", "disabled", "readOnly", "checked"],
  emits: ["update:modelValue"],
};
</script>
