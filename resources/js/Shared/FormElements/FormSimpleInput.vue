<template>
    <div class="mb-2">
        <label
            :for="name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >{{ label }}</label
        >
        <input
            :type="type"
            :name="name"
            :placeholder="placeholder ?? ''"
            :id="name"
            :value="readOnly ?? modelValue"
            :disabled="disabled"
            @input="$emit('update:modelValue', $event.target.value)"
            :class="{
                'border-2 border-rose-500': error,
                'cursor-not-allowed': disabled,
            }"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        />
        <div
            v-if="error"
            v-text="error"
            class="text-red-500 text-xs mt-1"
        ></div>
    </div>
</template>
<script>
export default {
    props: [
        "label",
        "type",
        "modelValue",
        "error",
        "name",
        "placeholder",
        "disabled",
        "readOnly",
    ],
    emits: ["update:modelValue"],
};
</script>
