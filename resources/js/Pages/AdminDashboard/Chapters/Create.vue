<template>
    <!-- Modal content -->
    <Modal
        :modalHeadingText="'Create new Chapter'"
        :modalHeadingResetButton="true"
        :modalWidth="2"
    >
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput
                        :label="'Chapter Name'"
                        :name="'name'"
                        @change="nameToSlug()"
                        :type="'text'"
                        v-model="chapterInfo.name"
                        :error="errors.name"
                    >
                    </FormSimpleInput>
                    <FormSimpleInput
                    :label="'Chapter Link'"
                    :name="'slug'"
                    :type="'text'"
                    :preText="'@'"
                    @change="createSlug()"
                    v-model="chapterInfo.slug"
                    :error="errors.slug"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Chapter Video Link'"
                    :name="'video'"
                    :type="'text'"
                    v-model="chapterInfo.video"
                    :error="errors.video"
                >
                </FormSimpleInput>
                </div>
                <div>
                    <FormFileUploadSingle
                        @fileChange="(file) => (chapterInfo.thumbnail = file[0])"
                        :label="'Chapter Thumbnail'"
                        :name="'thumbnail'"
                        :hideInputBox="true"
                        :error="errors.thumbnail"
                    ></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormTextEditor
                    v-model="chapterInfo.description"
                    :label="'Chapter Description'"
                    :name="'description'"
                    :error="errors.description"
                ></FormTextEditor>
                <FormSelect
                    :label="'Assign Course'"
                    :name="'course_id'"
                    :selected="courseId"
                    v-model="chapterInfo.course_id"
                    :error="errors.course_id"
                    :optionsArray="courses"
                    :optionName="'name'"
                    :optionValue="'id'"
                >
                </FormSelect>
            </div>
        </template>
        <template #footer>
            <Button
                @click.prevent="createRequest({ url : '/admin-dashboard/chapters', data : chapterInfo, only: ['flash', 'errors']})"
                :text="'Create Chapter'"
                :color="'blue'"
            ></Button>
        </template>
    </Modal>
</template>
<script>
export default {
    props: ["errors","courses","courseId"],
    data() {
        return {
            chapterInfo: {}
        };
    },
    mounted(){
        this.chapterInfo.course_id = this.courseId ?? 1
    },
    methods: {
        nameToSlug(){
            this.chapterInfo.slug = changeToSlug(this.chapterInfo.name)
        },
        createSlug(){
            this.chapterInfo.slug = changeToSlug(this.chapterInfo.name,this.chapterInfo.slug)
        }
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

import { changeToSlug,createRequest } from '../../../main.js'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
