<template>
    <section class="bg-gray-50 min-h-screen dark:bg-gray-800">
        <div
            class="flex flex-col items-center justify-center px-6 py-2 mx-auto h-screen"
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
                class="w-full bg-white rounded-lg shadow sm:max-w-md dark:bg-gray-800"
            >
                <div class="p-6 space-y-4 sm:p-8">
                    <h2 class="pb-2 border-b-2">Sign in</h2>
                    <form class="space-y-4" action="#" @submit.prevent="">
                        <FormSimpleInput
                            :label="'Your Email'"
                            :name="'email'"
                            :type="'email'"
                            v-model="loginInfo.email"
                            :error="errors.email"
                        >
                        </FormSimpleInput>

                        <FormSimpleInput
                            :label="'Password'"
                            :name="'password'"
                            :type="'password'"
                            v-model="loginInfo.password"
                            :error="errors.password"
                        >
                        </FormSimpleInput>

                        <div class="flex items-center justify-between">
                            <FormCheckBox
                                :label="'Remember Me'"
                                :name="'remember_me'"
                                :checked="false"
                                v-model="loginInfo.remember"
                                :error="errors.remember"
                            >
                            </FormCheckBox>
                            <!-- <Link
                                href="#"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Forgot password?</Link
                            > -->
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
    props:['errors'],
    data() {
        return {
            loginInfo: {},
        };
    },
    methods: {
        login() {
            router.post("/login", this.loginInfo, {
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
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
defineProps({ errors: Object });

</script>
