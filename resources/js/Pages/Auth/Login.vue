<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div
            class="flex flex-col items-center justify-center px-6 py-2 mx-auto h-screen md:h-[768px] lg:py-0"
        >
            <Link
                href="#"
                class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"
            >
                <img
                    class="w-8 h-8 mr-2"
                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                    alt="logo"
                />
                Flowbite
            </Link>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h2>Sign in to your account</h2>
                    <form
                        class="space-y-4 md:space-y-6"
                        action="#"
                        @submit.prevent=""
                    >
                        <div>
                            <FormSimpleInput
                                :label="'Your Email'"
                                :name="'email'"
                                :type="'email'"
                                v-model="loginInfo.email"
                                :error="errors.email"
                            >
                            </FormSimpleInput>
                        </div>
                        <div>
                            <FormSimpleInput
                                :label="'Password'"
                                :name="'password'"
                                :type="'password'"
                                v-model="loginInfo.password"
                                :error="errors.password"
                            >
                            </FormSimpleInput>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <FormCheckBox
                                    :label="'Remember Me'"
                                    :name="'remember_me'"
                                    :checked="false"
                                    v-model="loginInfo.remember_me"
                                    :error="$page.props.errors.remember_me"
                                >
                                </FormCheckBox>
                            </div>
                            <Link
                                href="#"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Forgot password?</Link
                            >
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
                            Don’t have an account yet?
                            <Link
                                href="/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Sign up
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
    data() {
        return {
            loginInfo: {},
            errors: this.$page.props.errors,
        };
    },
    methods: {
        login() {
            router.post("/login", this.loginInfo, {
                preserveScroll: true,
                preserveState: false,
                only: ["errors"],
            });
        },
    },
};
</script>
<script setup>
import FormSimpleInput from "../../Shared/FormElements/FormSimpleInput.vue";
import FormCheckBox from "../../Shared/FormElements/FormCheckBox.vue";
import Button from '../../Shared/FormElements/Button.vue';
</script>
