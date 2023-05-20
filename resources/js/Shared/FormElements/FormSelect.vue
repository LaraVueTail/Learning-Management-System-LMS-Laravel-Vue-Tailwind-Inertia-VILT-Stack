<template>
  <div>
    <label
      :for="name"
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
      >{{ label }}</label
    >
    <select
      :id="name"
      required
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
      :class="{
        'border-2 border-rose-500': error,
      }"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
    >
      <option
        v-for="option in optionsArray"
        :key="option"
        :value="option[optionValue]"
        :selected="selected === option[optionValue]"
        v-html="option[optionName]"
      ></option>
      <!-- <option value="TV">TV/Monitors</option>
                                    <option value="PC">PC</option>
                                    <option value="GA">Gaming/Console</option>
                                    <option value="PH">Phones</option> -->
    </select>
    <div v-if="error" v-text="error" class="text-red-500 text-xs mt-1"></div>
  </div>
</template>
<script>
export default {
  props: [
    "label",
    "selected",
    "modelValue",
    "error",
    "name",
    "optionsArray",
    "optionName",
    "optionValue",
  ],
  emits: ["update:modelValue"],
};
</script>
