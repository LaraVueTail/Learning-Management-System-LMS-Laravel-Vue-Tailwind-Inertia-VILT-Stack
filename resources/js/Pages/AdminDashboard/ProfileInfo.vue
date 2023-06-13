<template>
    <div class="w-1/2">
        <h2 class="my-4">Profile Settings</h2>
        <div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput :label="'First Name'" :name="'first_name'" @change="nameToSlug()" :type="'text'"
                        v-model="teacherInfo.first_name" :error="errors.first_name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Last Name'" :name="'last_name'" @change="nameToSlug()" :type="'text'"
                        v-model="teacherInfo.last_name" :error="errors.last_name">
                    </FormSimpleInput>
                    <FormSimpleInput :label="'Teacher Email'" :name="'email'" :type="'email'" v-model="teacherInfo.email"
                        :error="errors.email">
                    </FormSimpleInput>
                </div>
                <div>
                    <FormFileUploadSingle @fileChange="(file) => (teacherInfo.avatar = file[0])" :label="'Profile Image'"
                        :oldImageLink="teacher.avatar_url" :rounded="true" :name="'avatar'" :hideInputBox="true"
                        :error="errors.avatar"></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput :label="'Profile Link'" :name="'slug'" :type="'text'" :preText="'@'" @change="createSlug()"
                    v-model="teacherInfo.slug" :error="errors.slug">
                </FormSimpleInput>
                <FormSimpleInput :label="'Designation'" :name="'designation'" :type="'text'"
                    v-model="teacherInfo.designation" :error="errors.designation">
                </FormSimpleInput>
                <FormSimpleInput :label="'Date of birth'" :name="'dob'" :type="'date'" v-model="teacherInfo.dob"
                    :error="errors.dob">
                </FormSimpleInput>
                <FormSimpleInput :label="'Phone Number'" :name="'phone_number'" :placeholder="'+91'" :type="'text'"
                    v-model="teacherInfo.phone_number" :error="errors.phone_number">
                </FormSimpleInput>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput :label="'Password'" :name="'password'" :type="'password'" v-model="teacherInfo.password"
                    :error="errors.password">
                </FormSimpleInput>
                <FormSimpleInput :label="'Confirm Password'" :name="'confirm_password'" :type="'password'"
                    v-model="teacherInfo.password_confirmation" :error="errors.password">
                </FormSimpleInput>
            </div>
            <Button @click.prevent="
                editRequest({
                    url: '/admin-dashboard/profile-info',
                    data: teacherInfo,
                    only: ['flash', 'errors', 'teacher'],
                })
                " :text="'Edit Teacher'" :color="'blue'" class="my-4"></Button>
        </div>
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
    props: ["teacher", "errors"],
    data() {
        return {
            teacherInfo: this.teacher,
        };
    },
    methods: {
        nameToSlug() {
            this.teacherInfo.slug = changeToSlug(this.fullName);
        },
        createSlug() {
            this.teacherInfo.slug = changeToSlug(this.fullName);
        },
    },
};
</script>
<script setup>
import Button from "../../Shared/FormElements/Button.vue";
import FormSimpleInput from "../../Shared/FormElements/FormSimpleInput.vue";
import FormFileUploadSingle from "../../Shared/FormElements/FormFileUploadSingle.vue";

import { changeToSlug, editRequest } from "../../main.js";
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
