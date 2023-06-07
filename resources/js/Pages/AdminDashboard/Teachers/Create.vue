<template>
    <!-- Modal content -->
    <Modal
        :modalHeadingText="'Create new Teacher'"
        :modalHeadingResetButton="true"
        :modalWidth="2"
    >
        <template #body>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <FormSimpleInput
                        :label="'First Name'"
                        :name="'first_name'"
                        @change="nameToSlug()"
                        :type="'text'"
                        v-model="teacherInfo.first_name"
                        :error="errors.first_name"
                    >
                    </FormSimpleInput>
                    <FormSimpleInput
                        :label="'Last Name'"
                        :name="'last_name'"
                        @change="nameToSlug()"
                        :type="'text'"
                        v-model="teacherInfo.last_name"
                        :error="errors.last_name"
                    >
                    </FormSimpleInput>
                    <FormSimpleInput
                        :label="'Teacher Email'"
                        :name="'email'"
                        :type="'email'"
                        v-model="teacherInfo.email"
                        :error="errors.email"
                    >
                    </FormSimpleInput>
                </div>
                <div>
                    <FormFileUploadSingle
                        @fileChange="(file) => (teacherInfo.avatar = file[0])"
                        :label="'Profile Image'"
                        :oldImageLink="oldAvatar"
                        :rounded="true"
                        :name="'avatar'"
                        :hideInputBox="true"
                        :error="errors.avatar"
                    ></FormFileUploadSingle>
                </div>
            </div>
            <FormSimpleInput
                :label="'Profile Link'"
                :name="'slug'"
                :type="'text'"
                :preText="'@'"
                @change="createSlug()"
                v-model="teacherInfo.slug"
                :error="errors.slug"
            >
            </FormSimpleInput>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput
                    :label="'Date of birth'"
                    :name="'dob'"
                    :type="'date'"
                    v-model="teacherInfo.dob"
                    :error="errors.dob"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Phone Number'"
                    :name="'phone_number'"
                    :placeholder="'+91'"
                    :type="'text'"
                    v-model="teacherInfo.phone_number"
                    :error="errors.phone_number"
                >
                </FormSimpleInput>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <FormSimpleInput
                    :label="'Password'"
                    :name="'password'"
                    :type="'password'"
                    v-model="teacherInfo.password"
                    :error="errors.password"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Confirm Password'"
                    :name="'confirm_password'"
                    :type="'password'"
                    v-model="teacherInfo.password_confirmation"
                    :error="errors.password"
                >
                </FormSimpleInput>
            </div>
            <FormCheckBox
                :label="'Provide Admin access to this Teacher'"
                :name="'is_admin'"
                :checked="false"
                v-model="teacherInfo.is_admin"
                :error="errors.is_admin"
            >
            </FormCheckBox>
        </template>
        <template #footer>
            <Button
                @click.prevent="createRequest({ url : '/admin-dashboard/teachers', data : teacherInfo, only: ['flash', 'errors']})"
                :text="'Create Teacher'"
                :color="'blue'"
            ></Button>
        </template>
    </Modal>
</template>
<script>

export default {
    props: ["errors"],
    data() {
        return {
            teacherInfo: {}
        };
    },
    computed:{
        fullName(){
            return (this.teacherInfo.first_name ?? '') +' '+ (this.teacherInfo.last_name ?? '')
        }
    },
    methods: {
        nameToSlug(){
            this.teacherInfo.slug = changeToSlug(this.fullName)
        },
        createSlug(){
            this.teacherInfo.slug = changeToSlug(this.fullName)
        }
    },
};
</script>
<script setup>
import Button from "../../../Shared/FormElements/Button.vue";
import FormSimpleInput from "../../../Shared/FormElements/FormSimpleInput.vue";
import FormFileUploadSingle from "../../../Shared/FormElements/FormFileUploadSingle.vue";
import Modal from "../../../Shared/Modal/Modal.vue";
import FormCheckBox from "../../../Shared/FormElements/FormCheckBox.vue";

import { changeToSlug,createRequest } from '../../../main.js'

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})


</script>
