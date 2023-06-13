<template>
    <DeleteAlert v-if="deleteId" :id="deleteId" @close="deleteId = false" :url="'/admin-dashboard/courses/'"
        :text="'Deleting the course will permanently removed from the database. You can\'t recover the course again. Are you sure about deleting?'">
    </DeleteAlert>
    <!-- Modal content -->
    <div class="grid lg:grid-cols-2 gap-6 w-full">
        <Modal :modalHeadingText="'Edit Course'" :modalHeadingResetButton="true" :modalWidth="2">
            <template #body>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <FormSimpleInput :label="'Course Name'" :name="'name'" @change="nameToSlug()" :type="'text'"
                            v-model="courseInfo.name" :error="errors.name">
                        </FormSimpleInput>

                        <FormSimpleInput :label="'Course Short Description'" :name="'short_description'" :type="'text'"
                            v-model="courseInfo.short_description" :error="errors.short_description">
                        </FormSimpleInput>
                    </div>
                    <div>
                        <FormFileUploadSingle @fileChange="(file) => (courseInfo.thumbnail = file[0])
                            " :label="'Course Thumbnail'" :oldImageLink="course.thumbnail_url" :name="'thumbnail'"
                            :hideInputBox="true" :error="errors.thumbnail"></FormFileUploadSingle>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <FormSimpleInput :label="'Course Link'" :name="'slug'" :type="'text'" :preText="'@'"
                        @change="createSlug()" v-model="courseInfo.slug" :error="errors.slug">
                    </FormSimpleInput>
                    <FormSelect :label="'Assign Teacher'" :name="'teacher_id'" :selected="courseInfo.teacher_id ?? 1"
                        v-model="courseInfo.teacher_id" :error="errors.teacher_id" :optionsArray="teachers"
                        :optionName="'full_name'" :optionValue="'id'" v-if="$page.props.is_admin_logged">
                    </FormSelect>
                </div>
                <FormTextEditor v-model="courseInfo.description" :label="'Course Description'" :name="'description'"
                    :error="errors.description"></FormTextEditor>
            </template>
            <template #footer>
                <Button @click.prevent="
                    editRequest({
                        url: '/admin-dashboard/courses/',
                        data: courseInfo,
                        dataId: course.id,
                        only: ['flash', 'errors', 'course'],
                    })
                    " :text="'Edit Course'" :color="'blue'"></Button>
                <Button @click.prevent="deleteId = course.id" :text="'Delete Course'" :color="'red'"
                    v-if="$page.props.is_admin_logged"></Button>
            </template>
        </Modal>
        <Modal :modalHeadingText="'Chapters'" :modalHeadingResetButton="true" :modalWidth="2">
            <template #body>
                <ChapterMiniCard v-for="chapter in chapters" :key="chapter" :chapter="chapter"></ChapterMiniCard>
            </template>
            <template #footer>
                <Link href="/admin-dashboard/chapters/create" :data="{ courseId: courseInfo.id }">
                <Button :text="'Create new Chapter'" :color="'blue'"></Button>
                </Link>
            </template>
        </Modal>
    </div>
</template>
<script>
export default {
    props: ["errors", "teachers", "course", "chapters"],
    data() {
        return {
            courseInfo: this.course,
            deleteId: false,
        };
    },
    methods: {
        nameToSlug() {
            this.courseInfo.slug = changeToSlug(this.courseInfo.name);
        },
        createSlug() {
            this.courseInfo.slug = changeToSlug(
                this.courseInfo.name,
                this.courseInfo.slug
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
import ChapterMiniCard from "../../../Shared/ChapterMiniCard.vue";

import { changeToSlug, editRequest } from "../../../main.js";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
