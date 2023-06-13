<template>
    <section class="bg-white dark:bg-gray-900 mb-24 max-w-screen-md px-4 mx-auto py-10">
        <h2>Dashboard</h2>

        <div class="mb-10">
            <h3 class="text-gray-600 text-sm dark:text-gray-300 my-2">Welcome, {{ student.full_name }}</h3>
            <Link :href="course ? `/courses/${course.slug}` : `/courses`"
                class="inline-flex items-center justify-center px-3 py-2 mr-3 font-medium text-center text-white text-sm rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
            {{ course ? 'Contd. Learning' : 'Checkout Courses' }}
            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            </Link>
        </div>

        <h2 class="mb-6">Account Info</h2>
        <div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput :label="'First Name'" :name="'first_name'" :type="'text'"
                        v-model="studentInfo.first_name" :error="errors.first_name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Last Name'" :name="'last_name'" :type="'text'" v-model="studentInfo.last_name"
                        :error="errors.last_name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Email'" :name="'email'" :type="'email'" v-model="studentInfo.email"
                        :error="errors.email">
                    </FormSimpleInput>
                    <FormSelect :label="'Assign Course'" :name="'course_id'" :selected="courseId"
                        v-model="studentInfo.course_id" :error="errors.course_id" :optionsArray="courses"
                        :optionName="'name'" :optionValue="'id'">
                    </FormSelect>
                </div>
                <div>
                    <FormFileUploadSingle @fileChange="(file) => (studentInfo.avatar = file[0])" :label="'Profile Image'"
                        :oldImageLink="student.avatar_url" :rounded="true" :name="'avatar'" :hideInputBox="true"
                        :error="errors.avatar"></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput :label="'Date of birth'" :name="'dob'" :type="'date'" v-model="studentInfo.dob"
                    :error="errors.dob">
                </FormSimpleInput>
                <FormSimpleInput :label="'Phone Number'" :name="'phone_number'" :placeholder="'+91'" :type="'text'"
                    v-model="studentInfo.phone_number" :error="errors.phone_number">
                </FormSimpleInput>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput :label="'Password'" :name="'password'" :type="'password'" v-model="studentInfo.password"
                    :error="errors.password">
                </FormSimpleInput>
                <FormSimpleInput :label="'Confirm Password'" :name="'confirm_password'" :type="'password'"
                    v-model="studentInfo.password_confirmation" :error="errors.password">
                </FormSimpleInput>
            </div>
        </div>
        <Button @click.prevent="
            editRequest({
                url: '/dashboard/',
                data: studentInfo,
                dataId: studentInfo.id,
                only: ['flash', 'errors', 'student'],
            })
            " :text="'Edit Info'" :color="'blue'" class="my-2"></Button>


    </section>
</template>
<script>
export default {
    props: ['student', 'course', 'errors'],
    data() {
        return {
            studentInfo: this.student,
        };
    },
}
</script>
<script setup>
import FormSimpleInput from '../../Shared/FormElements/FormSimpleInput.vue';
import FormFileUploadSingle from "../../Shared/FormElements/FormFileUploadSingle.vue";
import Button from '../../Shared/FormElements/Button.vue';

import { editRequest } from "../../main.js";

import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>