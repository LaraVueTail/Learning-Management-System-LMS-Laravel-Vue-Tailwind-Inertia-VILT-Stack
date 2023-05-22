<template>
    <h2>Posts</h2>
    <DeleteAlert
                v-if="deleteAlertPost"
                @close="deleteAlertPost = false"
                @confirm="deletePostConfirm()"
                :text="deleteAlertPostText"
            ></DeleteAlert>
    <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200 max-w-5xl my-4"
    >
        <Filters
            :searchPlaceHolder="'Search by Post ID, Heading, Sub Heading..'"
            :filters="filters"
            :currentPage="posts.current_page"
            :dataName="'posts'"
            :sortByFilters="{ dateSort: true }"
            :enableFilters="{
                search: true,
                dateRange: true,
                sortBy: true,
                filterByFiltersEnabled: [
                    {
                        name: 'status',
                        slug: 'status',
                        options: [
                            { name: 'Published', value: 'published' },
                            { name: 'Draft', value: 'draft' },
                        ],
                    },
                ],
            }"
        ></Filters>
        <Table
            :data="posts.data"
            :tableContent="[
                { heading: 'ID', type: 'text', value: 'id' },
                { heading: 'Thumbnail', type: 'image', value: 'thumbnail_url' },
                { heading: 'Title', type: 'text', value: 'heading' },
                { heading: 'Category', type: 'text', value: 'category_id' },
            ]"
            :actionLinks="[{ link: 'admin-dashboard/posts', name: 'Edit' }]"
            :deleteEnable="true"
            @deleteItem="deletePost"
        ></Table>
        <!-- <PageNavigation :data="posts"></PageNavigation> -->
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
    props: ["posts", "filters"],
    data() {
        return {
            deleteAlertPost: false,
            deleteAlertPostText: "",
            deletePostId:null
        }
    },
    methods: {
        deletePost(postId) {
            window.scrollTo(0, 0);
            this.deleteAlertPost = true;
            this.deletePostId = postId
            this.deleteAlertPostText = `Deleting the post will permanently removed from the database. You can't recover the
        post again. Are you sure about deleting?`;
            setTimeout(() => (this.deleteAlertPost = false), 5000);
        },
        deletePostConfirm() {
            router.delete(`/admin-dashboard/posts/${this.deletePostId}`);
            this.deleteAlertPost = false;

        },
    },
};
</script>
<script setup>
import PageNavigation from "../../../Shared/PageNavigation.vue";
import Table from "../../../Shared/Table.vue";
import Filters from "../../../Shared/Filters/Filters.vue";
import DeleteAlert from "../../../Shared/DeleteAlert.vue";

</script>
