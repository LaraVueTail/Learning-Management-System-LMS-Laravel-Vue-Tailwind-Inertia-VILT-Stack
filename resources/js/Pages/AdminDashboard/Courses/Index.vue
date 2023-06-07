<template>
    <h2>Courses</h2>
    <DeleteAlert
        v-if="deleteId"
        :id="deleteId"
        @close="deleteId = false"
        :url="'/admin-dashboard/courses/'"
        :text="'Deleting the course will permanently removed from the database. You can\'t recover the course again. Are you sure about deleting?'"
    ></DeleteAlert>
    <TableLayout>
        <Filters
            :searchPlaceHolder="'Search by Course ID, Name, short-description ..'"
            :filters="filters"
            :currentPage="courses.current_page"
            :dataName="'courses'"
            :sortByFilters="{ dateSort: true }"
            :enableFilters="{
                search: true,
                dateRange: true,
                sortBy: true,
                filterByFiltersEnabled: [
                    {
                        name: 'Teachers',
                        slug: 'teacher',
                        valueKey:'slug',
                        nameKey: 'full_name',
                        options: teachers,
                    },
                ],
            }"
        ></Filters>
        <TableNew
            :data="courses.data"
            :tableContent="[
                { heading: 'Thumbnail', type: 'image', value: 'thumbnail_url' },
                { heading: 'Name', type: 'text', value: 'name' },
                { heading: 'Short Description', type: 'text', value: 'short_description' },
                { heading: 'Teacher', type: 'relation', values: ['teacher','full_name'] },
            ]"
            :actionLinks="[{ link: 'admin-dashboard/courses', name: 'Edit' }]"
            :deleteEnable="true"
            @deleteItem="(id) => deleteId = id"
        ></TableNew>
        <PageNavigation :data="courses"></PageNavigation>
    </TableLayout>
</template>
<script>
export default {
    props: ["courses", "filters",'teachers'],
    data() {
        return {
            deleteId: false,
        };
    }
};
</script>
<script setup>
import PageNavigation from "../../../Shared/Table/PageNavigation.vue";
import Filters from "../../../Shared/Filters/Filters.vue";
import DeleteAlert from "../../../Shared/DeleteAlert.vue";
import TableNew from "../../../Shared/Table/Table.vue";
import TableLayout from "../../../Shared/Table/TableLayout.vue";
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
