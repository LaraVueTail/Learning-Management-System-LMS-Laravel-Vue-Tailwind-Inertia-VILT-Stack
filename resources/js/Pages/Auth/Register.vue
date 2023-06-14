<template>
    <section class="bg-gray-50 dark:bg-gray-800 min-h-screen">
        <div
            class="flex flex-col items-center justify-center px-2 md:px-6 pt-10 pb-24 md:py-20 mx-auto"
        >
            <Link
                href="#"
                class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"
            >
                <img
                    class="w-10 h-10 mr-2"
                    src="/Sitelogo/logo.svg"
                    alt="logo"
                />
                MasterLearn
            </Link>
            <div
                class="w-full bg-white rounded-lg shadow sm:max-w-xl dark:bg-gray-800"
            >
                <div class="px-4 py-6 md:p-6 space-y-4 sm:p-8">
                    <h2 class="pb-2 border-b-2">Create new account</h2>
                    <form class="space-y-4" action="#" @submit.prevent="">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <FormSimpleInput
                                    :label="'Your Email'"
                                    :name="'email'"
                                    :type="'email'"
                                    v-model="registerInfo.email"
                                    :error="errors.email"
                                >
                                </FormSimpleInput>
                                <FormSimpleInput
                                    :label="'First Name'"
                                    :name="'first_name'"
                                    :type="'text'"
                                    v-model="registerInfo.first_name"
                                    :error="errors.first_name"
                                >
                                </FormSimpleInput>
                                <FormSimpleInput
                                    :label="'Last Name'"
                                    :name="'last_name'"
                                    :type="'text'"
                                    v-model="registerInfo.last_name"
                                    :error="errors.last_name"
                                >
                                </FormSimpleInput>
                            </div>
                            <div>
                                <FormFileUploadSingle
                                    @fileChange="(file) => (avatar = file[0])"
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
                                v-model="registerInfo.dob"
                                :error="errors.dob"
                            >
                            </FormSimpleInput>
                            <FormSimpleInput
                                :label="'Phone Number'"
                                :name="'phone_number'"
                                :placeholder="'+91'"
                                :type="'text'"
                                v-model="registerInfo.phone_number"
                                :error="errors.phone_number"
                            >
                            </FormSimpleInput>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <FormSimpleInput
                                :label="'Password'"
                                :name="'password'"
                                :type="'password'"
                                v-model="registerInfo.password"
                                :error="errors.password"
                            >
                            </FormSimpleInput>
                            <FormSimpleInput
                                :label="'Confirm Password'"
                                :name="'confirm_password'"
                                :type="'password'"
                                v-model="registerInfo.password_confirmation"
                                :error="errors.password"
                            >
                            </FormSimpleInput>
                        </div>
                        <div>
                            <div>
                                <FormCheckBox
                                    :label="'Agree to the Terms and Conditions'"
                                    :link="'/login'"
                                    :name="'tac'"
                                    :checked="false"
                                    v-model="registerInfo.tac"
                                    :error="errors.tac"
                                >
                                </FormCheckBox>
                            </div>
                        </div>
                        <Button
                            @click.prevent="login()"
                            :text="'Sign in'"
                            :color="'blue'"
                            :fullWidth="true"
                        ></Button>
                        <p
                            class="text-sm font-light text-gray-700 dark:text-gray-400"
                        >
                            Already have an account?
                            <Link
                                href="/login"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Sign in
                            </Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
    props:['errors'],
    data() {
        return {
            registerInfo: {},
        };
    },
    methods: {
        login() {
            router.post("/register", this.registerInfo, {
                preserveScroll: true,
                preserveState: true,
                only:['errors']
            });
        },
    },
};
</script>
<script setup>
import FormSimpleInput from "../../Shared/FormElements/FormSimpleInput.vue";
import FormCheckBox from "../../Shared/FormElements/FormCheckBox.vue";
import Button from "../../Shared/FormElements/Button.vue";
import FormFileUploadSingle from "../../Shared/FormElements/FormFileUploadSingle.vue";

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
