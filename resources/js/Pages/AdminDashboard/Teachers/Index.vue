<template>
    <h2>Teachers</h2>
    <DeleteAlert
        v-if="deleteId"
        :id="deleteId"
        @close="deleteId = false"
        :url="'/admin-dashboard/teachers/'"
        :text="'Deleting the teacher will permanently removed from the database. You can\'t recover the teacher again. Are you sure about deleting ?'"
    ></DeleteAlert>
    <TableLayout>
        <Filters
            :searchPlaceHolder="'Search by Teacher ID, Email, Name ..'"
            :filters="filters"
            :currentPage="teachers.current_page"
            :dataName="'teachers'"
            :sortByFilters="{ dateSort: true }"
            :enableFilters="{
                search: true,
                dateRange: true,
                sortBy: true,
                filterByFiltersEnabled: [
                    {
                        name: 'status',
                        slug: 'status',
                        valueKey:'value',
                        nameKey:'name',
                        options: [
                            { name: 'Published', value: 'published' },
                            { name: 'Draft', value: 'draft' },
                        ],
                    },
                ],
            }"
        ></Filters>
        <TableNew
            :data="teachers.data"
            :tableContent="[
                { heading: 'avatar', type: 'image', value: 'avatar_url', rounded: true },
                { heading: 'First Name', type: 'text', value: 'first_name' },
                { heading: 'Last Name', type: 'text', value: 'last_name' },
                { heading: 'Email', type: 'text', value: 'email' },
            ]"
            :actionLinks="[{ link: 'admin-dashboard/teachers', name: 'Edit' }]"
            :deleteEnable="true"
            @deleteItem="(id) => deleteId = id"
        ></TableNew>
        <PageNavigation :data="teachers"></PageNavigation>
    </TableLayout>
</template>
<script>
export default {
    props: ["teachers", "filters"],
    data() {
        return {
            deleteId: false
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
