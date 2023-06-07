<template>
    <!-- Modal content -->
    <Modal
        :modalHeadingText="'Create new Student'"
        :modalHeadingResetButton="true"
        :modalWidth="2"
    >
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput
                        :label="'First Name'"
                        :name="'first_name'"
                        :type="'text'"
                        v-model="studentInfo.first_name"
                        :error="errors.first_name"
                    >
                    </FormSimpleInput>
                    <FormSimpleInput
                        :label="'Last Name'"
                        :name="'last_name'"
                        :type="'text'"
                        v-model="studentInfo.last_name"
                        :error="errors.last_name"
                    >
                    </FormSimpleInput>
                    <FormSimpleInput
                        :label="'Email'"
                        :name="'email'"
                        :type="'email'"
                        v-model="studentInfo.email"
                        :error="errors.email"
                    >
                    </FormSimpleInput>
                    <FormSelect
                    :label="'Assign Course'"
                    :name="'course_id'"
                    :selected="courseId"
                    v-model="studentInfo.course_id"
                    :error="errors.course_id"
                    :optionsArray="courses"
                    :optionName="'name'"
                    :optionValue="'id'"
                >
                </FormSelect>
                </div>
                <div>
                    <FormFileUploadSingle
                        @fileChange="(file) => (studentInfo.avatar = file[0])"
                        :label="'Profile Image'"
                        :oldImageLink="oldAvatar"
                        :rounded="true"
                        :name="'avatar'"
                        :hideInputBox="true"
                        :error="errors.avatar"
                    ></FormFileUploadSingle>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput
                    :label="'Date of birth'"
                    :name="'dob'"
                    :type="'date'"
                    v-model="studentInfo.dob"
                    :error="errors.dob"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Phone Number'"
                    :name="'phone_number'"
                    :placeholder="'+91'"
                    :type="'text'"
                    v-model="studentInfo.phone_number"
                    :error="errors.phone_number"
                >
                </FormSimpleInput>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput
                    :label="'Password'"
                    :name="'password'"
                    :type="'password'"
                    v-model="studentInfo.password"
                    :error="errors.password"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Confirm Password'"
                    :name="'confirm_password'"
                    :type="'password'"
                    v-model="studentInfo.password_confirmation"
                    :error="errors.password"
                >
                </FormSimpleInput>
            </div>
            <FormCheckBox
                :label="'Agree to Terms and Conditions'"
                :name="'tac'"
                :checked="true"
                v-model="studentInfo.tac"
                :error="errors.tac"
            >
            </FormCheckBox>
        </template>
        <template #footer>
            <Button
                @click.prevent="createRequest({ url : '/admin-dashboard/students', data : studentInfo, only: ['flash', 'errors']})"
                :text="'Create Student'"
                :color="'blue'"
            ></Button>
        </template>
    </Modal>
</template>
<script>

export default {
    props: ["errors","courses"],
    data() {
        return {
            studentInfo: {}
        };
    },
    mounted(){
        this.studentInfo.tac = true
    },
};
</script>
<script setup>
import Button from "../../../Shared/FormElements/Button.vue";
import FormSimpleInput from "../../../Shared/FormElements/FormSimpleInput.vue";
import FormFileUploadSingle from "../../../Shared/FormElements/FormFileUploadSingle.vue";
import Modal from "../../../Shared/Modal/Modal.vue";
import FormCheckBox from "../../../Shared/FormElements/FormCheckBox.vue";
import FormSelect from "../../../Shared/FormElements/FormSelect.vue";

import { createRequest } from '../../../main.js'

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})


</script>
