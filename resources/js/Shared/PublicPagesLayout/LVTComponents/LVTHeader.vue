<template>
    <header class="shadow-xl">
        <nav class="bg-zinc-900 border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-900">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://laravuetail.com" class="flex items-center">
                    <img class="h-8 w-auto mr-3" :src="$page.props.app_url + 'Sitelogo/laravuetail-logo.png'" alt="" />
                    <p class="text-sm text-gray-100 font-poppins">
                        <span class="text-[#ff2d20]">Lara</span><span class="text-[#41b883]">Vue</span><span
                            class="text-[#38bdf8]">Tail</span>
                        <span class="text-gray-100 font-medium ml-1">{{ projectName }}</span>
                    </p>
                </a>
                <div class="flex items-center lg:order-2 md:hidden">
                    <!-- <a
                        href="/login"
                        class="text-gray-300 dark:text-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                        >Log in</a
                    >
                    <a
                        href="#"
                        class="text-white bg-tailwind hover:bg-vue focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        >Get started</a
                    > -->
                    <button data-collapse-toggle="mobile-menu-lvt" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-400 rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-gray-500"
                        aria-controls="mobile-menu-lvt" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-lvt">
                    <ul class="flex flex-col mt-4 lg:flex-row lg:space-x-8 lg:mt-0 text-sm">
                        <li>
                            <a href="/"
                                class="block py-2 pr-4 pl-3 text-tailwind hover:text-vue border-b border-gray-100 lg:border-0 lg:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a :href="projectDocsLink"
                                class="block py-2 pr-4 pl-3 text-gray-300 hover:text-vue border-b border-gray-100 lg:border-0 lg:p-0">Docs</a>
                        </li>
                        <li>
                            <a :href="projectGithubRepo" target="_blank"
                                class="block py-2 pr-4 pl-3 text-gray-300 hover:text-vue border-b border-gray-100 lg:border-0 lg:p-0">Github
                                Repo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
export default {
    props: ["projectName", "projectDocsLink", "projectGithubRepo"]
}
</script>
<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
