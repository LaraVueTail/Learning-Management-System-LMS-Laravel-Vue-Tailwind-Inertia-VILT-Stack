<template>
    <section class="dark:bg-gray-900 bg-gray-50">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    {{ heading }}
                </h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                    {{ subHeading }}
                </p>
            </div>
            <div class="mb-6">
                <Filters :searchPlaceHolder="'Search by Course ID, Name, short-description ..'"
                    :filters="$page.props.filters" :currentPage="data.current_page" :dataName="''" :sendToUrl="'/courses'"
                    :sortByFilters="{ dateSort: true }" :enableFilters="{
                        search: true,
                        dateRange: false,
                        sortBy: true,
                        filterByFiltersEnabled: [
                            {
                                name: 'Teachers',
                                slug: 'teacher',
                                valueKey: 'slug',
                                nameKey: 'full_name',
                                options: $page.props.teachers,
                            },
                        ],
                    }"></Filters>
            </div>

            <Grid :data="data.data"></Grid>

            <div class="mx-auto max-w-screen-sm my-10">
                <PageNavigation :data="data"></PageNavigation>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props: ["data", "heading", "subHeading"],
};
</script>
<script setup>
import PageNavigation from "../../../Shared/Table/PageNavigation.vue";
import Grid from "../../../Shared/Course/Grid.vue";
import Filters from "../../../Shared/Filters/Filters.vue";

import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
