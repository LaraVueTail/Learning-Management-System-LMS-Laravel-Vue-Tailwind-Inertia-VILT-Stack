<template>
  <div>
    <label
      :for="name"
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <div class="grid gap-0 overflow-y-auto">
      <QuillEditor
        theme="snow"
        :content="modelValue"
        content-type="html"
        toolbar="minimal"
        ref="textEditor"
        @update:content="$emit('update:modelValue', $refs.textEditor.getContents())"
      />
    </div>

    <div v-if="error" v-text="error" class="text-red-500 text-xs mt-1"></div>
  </div>
</template>
<script>
export default {
  props: ["label", "modelValue", "error", "name"],
  emits: ["update:modelValue"],
};
</script>

<script setup>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
</script>
