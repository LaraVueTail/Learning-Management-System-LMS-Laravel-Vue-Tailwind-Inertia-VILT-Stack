<template>
    <h2>Chapters</h2>
    <DeleteAlert
        v-if="deleteId"
        :id="deleteId"
        @close="deleteId = false"
        :url="'/admin-dashboard/chapters/'"
        :text="'Deleting the chapter will permanently removed from the database. You can\'t recover the chapter again. Are you sure about deleting?'"
    ></DeleteAlert>
    <TableLayout>
        <Filters
            :searchPlaceHolder="'Search by Chapter ID, Name, Description ..'"
            :filters="filters"
            :currentPage="chapters.current_page"
            :dataName="'chapters'"
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
            :data="chapters.data"
            :tableContent="[
                { heading: 'Thumbnail', type: 'image', value: 'thumbnail_url' },
                { heading: 'Name', type: 'text', value: 'name' },
                { heading: 'Course', type: 'relation', values: ['course','name'] },
            ]"
            :actionLinks="[{ link: 'admin-dashboard/chapters', name: 'Edit' }]"
            :deleteEnable="true"
            @deleteItem="(id) => deleteId = id"
        ></TableNew>
        <PageNavigation :data="chapters"></PageNavigation>
    </TableLayout>
</template>
<script>
export default {
    props: ["courses", "filters",'chapters'],
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
