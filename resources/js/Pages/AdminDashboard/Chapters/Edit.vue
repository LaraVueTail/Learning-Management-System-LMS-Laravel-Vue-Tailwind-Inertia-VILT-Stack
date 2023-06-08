<template>
    <DeleteAlert v-if="deleteId" :id="deleteId" @close="deleteId = false" :url="'/admin-dashboard/chapters/'"
        :text="'Deleting the chapter will permanently removed from the database. You can\'t recover the chapter again. Are you sure about deleting?'">
    </DeleteAlert>
    <!-- Modal content -->
    <Modal :modalHeadingText="'Edit Chapter'" :modalHeadingResetButton="true" :modalWidth="2">
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput :label="'Chapter Name'" :name="'name'" @change="nameToSlug()" :type="'text'"
                        v-model="chapterInfo.name" :error="errors.name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Chapter Link'" :name="'slug'" :type="'text'" :preText="'@'"
                        @change="createSlug()" v-model="chapterInfo.slug" :error="errors.slug">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Chapter Video Link'" :name="'video'" :type="'text'"
                        v-model="chapterInfo.video" :error="errors.video">
                    </FormSimpleInput>
                </div>
                <div>
                    <FormFileUploadSingle @fileChange="(file) => (chapterInfo.thumbnail = file[0])
                        " :label="'Chapter Thumbnail'" :name="'thumbnail'" :oldImageLink="chapterInfo.thumbnail_url"
                        :hideInputBox="true" :error="errors.thumbnail"></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormTextEditor v-model="chapterInfo.description" :label="'Chapter Description'" :name="'description'"
                    :error="errors.description"></FormTextEditor>
                <FormSelect :label="'Assign Course'" :name="'course_id'" :selected="chapterInfo.course_id ?? 1"
                    v-model="chapterInfo.course_id" :error="errors.course_id" :optionsArray="courses" :optionName="'name'"
                    :optionValue="'id'">
                </FormSelect>
            </div>
        </template>
        <template #footer>
            <Button @click.prevent="
                editRequest({
                    url: '/admin-dashboard/chapters/',
                    data: chapterInfo,
                    dataId: chapter.id,
                    only: ['flash', 'errors', 'chapter'],
                })
                " :text="'Edit Chapter'" :color="'blue'"></Button>
            <Button @click.prevent="deleteId = chapter.id" :text="'Delete Chapter'" :color="'red'"></Button>
        </template>
    </Modal>
</template>
<script>
export default {
    props: ["errors", "courses", "chapter"],
    data() {
        return {
            chapterInfo: this.chapter,
            deleteId: false,
        };
    },
    methods: {
        nameToSlug() {
            this.chapterInfo.slug = changeToSlug(this.chapterInfo.name);
        },
        createSlug() {
            this.chapterInfo.slug = changeToSlug(
                this.chapterInfo.name,
                this.chapterInfo.slug
            );
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
import Modal from "../../../Shared/Modal/Modal.vue";
import DeleteAlert from "../../../Shared/DeleteAlert.vue";

import { changeToSlug, editRequest } from "../../../main.js";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
