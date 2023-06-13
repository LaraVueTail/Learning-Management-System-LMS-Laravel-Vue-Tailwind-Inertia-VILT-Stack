<template>
    <div class="fixed top-24 right-10 flex p-4 mb-4 text-sm z-30 shadow-xl rounded-lg"
        :class="{ 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400': flash.success, 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400': flash.error }"
        role="alert" v-if="show && (flash.success || flash.error)">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <!-- <span class="font-medium" v-if="$page.props.flash.success">Success!, </span>
            <span class="font-medium" v-if="$page.props.flash.error">Success!, </span> -->
            {{ $page.props.flash.success || $page.props.flash.error }}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: false,
        };
    },
    mounted() {
        this.show = true;
        setTimeout(() => (this.show = false), 3000);
    },
    computed: {
        flash() {
            return this.$page.props.flash;
        },
    },
    watch: {
        flash: {
            deep: true,
            handler(val, oldVal) {
                this.show = true;
                setTimeout(() => (this.show = false), 3000);
            },
        },
    },
};
</script>
