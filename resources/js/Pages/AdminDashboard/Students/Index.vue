<template>
    <h2>Chapters</h2>
    <DeleteAlert
        v-if="deleteId"
        :id="deleteId"
        @close="deleteId = false"
        :url="'/admin-dashboard/students/'"
        :text="'Deleting the student will permanently removed from the database. You can\'t recover the student again. Are you sure about deleting?'"
    ></DeleteAlert>
    <TableLayout>
        <Filters
            :searchPlaceHolder="'Search by Student ID, Name, Email ..'"
            :filters="filters"
            :currentPage="students.current_page"
            :dataName="'students'"
            :sortByFilters="{ dateSort: true }"
            :enableFilters="{
                search: true,
                dateRange: true,
                sortBy: true,
                filterByFiltersEnabled: [
                    {
                        name: 'Courses',
                        slug: 'course',
                        valueKey:'slug',
                        nameKey: 'name',
                        options: courses,
                    },
                ],
            }"
        ></Filters>
        <TableNew
            :data="students.data"
            :tableContent="[
                { heading: 'Avatar', type: 'image', value: 'avatar_url' },
                { heading: 'Name', type: 'text', value: 'full_name' },
                { heading: 'Email', type: 'text', value: 'email' },
                { heading: 'Course', type: 'relation', values: ['course','name'] },
            ]"
            :actionLinks="[{ link: 'admin-dashboard/students', name: 'Edit' }]"
            :deleteEnable="true"
            @deleteItem="(id) => deleteId = id"
        ></TableNew>
        <PageNavigation :data="students"></PageNavigation>
    </TableLayout>
</template>
<script>
export default {
    props: ["courses", "filters",'students'],
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
