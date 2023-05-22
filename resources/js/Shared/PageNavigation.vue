<template>
    <nav
        class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
        aria-label="Table navigation"
    >
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white"
                >{{ data.from }}-{{ data.to }}</span
            >
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{
                data.total
            }}</span>
        </span>

        <div class="inline-flex items-stretch -space-x-px">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in data.links"
                :href="link.url"
                v-html="link.label"
                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white hidden md:block"
                :class="{
                    'text-gray-500': !link.url,
                    'font-bold': link.active,
                    'rounded-l-lg': link.label.includes('Previous'),
                    'rounded-r-lg': link.label.includes('Next'),
                }"
            />
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in dataLinksMobile"
                :href="link.url"
                v-html="link.label"
                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:hidden"
                :class="{
                    'text-gray-500': !link.url,
                    'font-bold': link.active,
                    'rounded-l-lg': link.label.includes('Previous'),
                    'rounded-r-lg': link.label.includes('Next'),
                }"
            />
        </div>
    </nav>
</template>
<script>
export default {
    props: ["data"],
    data() {
        return {
            dataLinksMobile:
                this.data.links.length > 7
                    ? [
                          this.data.links[0],
                          this.data.links[this.data.links.length - 1],
                      ]
                    : this.data.links,
        };
    },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
</script>
