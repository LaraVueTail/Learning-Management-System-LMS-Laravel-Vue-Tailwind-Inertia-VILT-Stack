<template>
    <!-- Modal content -->
        <div :class="`w-full max-w-${modalWidth}xl max-h-full`">
            <div
                class="relative bg-white rounded-lg shadow-xl dark:bg-gray-800"
            >
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                >
                    <h2>{{ modalHeadingText }}</h2>
                    <button
                        type="button"
                        v-if="modalHeadingResetButton"
                        @click="reloadPage"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"
                            />
                        </svg>
                        <span class="sr-only">Reset modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-2 md:p-6 space-y-6">
                    <slot name="body"></slot>
                </div>
                <!-- Modal footer -->
                <Errors :errors="$page.props.errors ?? false"></Errors>
                <div
                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                >
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    props: ["modalHeadingText", "modalHeadingResetButton", "modalWidth"],
    methods: {
        reloadPage() {
            router.get(this.$page.url);
        },
    },
};
</script>
<script setup>
import { router } from "@inertiajs/vue3";
import Errors from "../FormElements/Errors.vue";
</script>
