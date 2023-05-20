<template>
    <!-- Main modal -->
    <div
        id="defaultModal"
        tabindex="-1"
        aria-hidden="false"
        class="w-full px-4 pt-4 pb-24 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700"
            >
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                >
                    <h2>Terms of Service</h2>
                    <button
                        type="button"
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
                <div class="p-6 space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <FormSimpleInput
                                :label="'Post Title'"
                                :name="'post_heading'"
                                @change="changeNameToSlug()"
                                :type="'text'"
                                v-model="postInfo.heading"
                                :error="$page.props.errors.heading ?? ''"
                            >
                            </FormSimpleInput>
                            <FormSimpleInput
                                :label="'Post Slug'"
                                :name="'post_slug'"
                                :type="'text'"
                                v-model="postInfo.slug"
                                @change="changeToSlug()"
                                :error="$page.props.errors.slug ?? ''"
                            >
                            </FormSimpleInput>
                            <FormSelect
                                :label="'Post Category'"
                                :name="'category_id'"
                                :selected="postInfo.category_id ?? 1"
                                v-model="postInfo.category_id"
                                :error="$page.props.errors.category_id"
                                :optionsArray="categories"
                                :optionName="'name'"
                                :optionValue="'id'"
                            >
                            </FormSelect>
                            <FormSimpleInput
                                :label="'Post Sub Heading'"
                                :name="'post_sub_heading'"
                                :type="'text'"
                                v-model="postInfo.sub_heading"
                                :error="$page.props.errors.sub_heading ?? ''"
                            >
                            </FormSimpleInput>
                            <FormTextEditor
                                v-model="postInfo.text_content"
                                :label="'Main Content'"
                                :name="'post_text_content'"
                                :error="$page.props.errors.text_content ?? ''"
                            ></FormTextEditor>
                        </div>
                        <div>
                            <FormFileUploadSingle
                                @fileChange="(file) => (thumbnail = file[0])"
                                :label="'Post Thumbnail'"
                                :oldImageLink="oldThumbnail"
                                :name="'post_thumbnail'"
                                :error="$page.props.errors.thumbnail ?? ''"
                            ></FormFileUploadSingle>
                            <FormSimpleInput
                                :label="'Post Keywords'"
                                :name="'post_keywords'"
                                :type="'text'"
                                v-model="postInfo.keywords"
                                :error="$page.props.errors.keywords ?? ''"
                            ></FormSimpleInput>
                            <FormSelect
                                :label="'Post Status'"
                                :name="'post_status'"
                                :selected="postInfo.status ?? 'Published'"
                                v-model="postInfo.status"
                                :error="$page.props.errors.status"
                                :optionsArray="statuses"
                                :optionName="'name'"
                                :optionValue="'value'"
                            >
                            </FormSelect>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <Errors :errors="$page.props.errors ?? false"></Errors>
                <div
                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                >
                    <Button
                        @click.prevent="createPost()"
                        :text="'Create Post'"
                        :color="'blue'"
                    ></Button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
    props: ["categories","errors"],
    data() {
        return {
            postInfo: {},
            thumbnail: null,
            statuses: [
                {
                    name: "Published",
                    value: "published",
                },
                {
                    name: "Draft",
                    value: "draft",
                },
            ],
        };
    },
    methods: {
        slugify(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/[\s_-]+/g, "-")
                .replace(/^-+|-+$/g, "");
        },
        changeNameToSlug() {
            this.postInfo.slug = this.slugify(this.postInfo.heading);
        },
        changeToSlug() {
            if (this.postInfo.slug !== "") {
                this.postInfo.slug = this.slugify(this.postInfo.slug);
            } else {
                this.postInfo.slug = this.slugify(this.postInfo.heading);
            }
        },
        createPost() {
            if (this.thumbnail) {
                this.postInfo.thumbnail = this.thumbnail;
            } else {
                delete this.postInfo.thumbnail;
            }
            router.post("/admin-dashboard/posts", this.postInfo, {
                preserveState: false,
                preserveScroll: true,
                only: ["flash","errors"],
            });
        },
    },
};
</script>
<script setup>
import Button from "../../../Shared/FormElements/Button.vue";
import FormSimpleInput from "../../../Shared/FormElements/FormSimpleInput.vue";
import FormTextEditor from "../../../Shared/FormElements/FormTextEditor.vue";
import FormFileUploadSingle from "../../../Shared/FormElements/FormFileUploadSingle.vue";
import FormSelect from "../../../Shared/FormElements/FormSelect.vue";
import Errors from '../../../Shared/FormElements/Errors.vue';
</script>
