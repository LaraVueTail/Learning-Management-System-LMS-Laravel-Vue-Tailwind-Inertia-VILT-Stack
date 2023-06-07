<template>
    <!-- Modal content -->
    <Modal
        :modalHeadingText="'Create new Course'"
        :modalHeadingResetButton="true"
        :modalWidth="2"
    >
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput
                        :label="'Course Name'"
                        :name="'name'"
                        @change="nameToSlug()"
                        :type="'text'"
                        v-model="courseInfo.name"
                        :error="errors.name"
                    >
                    </FormSimpleInput>

                    <FormSimpleInput
                        :label="'Course Short Description'"
                        :name="'short_description'"
                        :type="'text'"
                        v-model="courseInfo.short_description"
                        :error="errors.short_description"
                    >
                    </FormSimpleInput>
                </div>
                <div>
                    <FormFileUploadSingle
                        @fileChange="(file) => (courseInfo.thumbnail = file[0])"
                        :label="'Course Thumbnail'"
                        :name="'thumbnail'"
                        :hideInputBox="true"
                        :error="errors.thumbnail"
                    ></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput
                    :label="'Course Link'"
                    :name="'slug'"
                    :type="'text'"
                    :preText="'@'"
                    @change="createSlug()"
                    v-model="courseInfo.slug"
                    :error="errors.slug"
                >
                </FormSimpleInput>
                <FormSelect
                    :label="'Assign Teacher'"
                    :name="'teacher_id'"
                    :selected="courseInfo.teacher_id ?? 1"
                    v-model="courseInfo.teacher_id"
                    :error="errors.teacher_id"
                    :optionsArray="teachers"
                    :optionName="'full_name'"
                    :optionValue="'id'"
                >
                </FormSelect>
            </div>
            <FormTextEditor
                    v-model="courseInfo.description"
                    :label="'Course Description'"
                    :name="'description'"
                    :error="errors.description"
                ></FormTextEditor>
        </template>
        <template #footer>
            <Button
                @click.prevent="createRequest({ url : '/admin-dashboard/courses', data : courseInfo, only: ['flash', 'errors']})"
                :text="'Create Course'"
                :color="'blue'"
            ></Button>
        </template>
    </Modal>
</template>
<script>
export default {
    props: ["errors","teachers"],
    data() {
        return {
            courseInfo: {}
        };
    },
    methods: {
        nameToSlug(){
            this.courseInfo.slug = changeToSlug(this.courseInfo.name)
        },
        createSlug(){
            this.courseInfo.slug = changeToSlug(this.courseInfo.name,this.courseInfo.slug)
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
