<template>
    <nav class="flex md:max-w-screen-xl px-4 mx-auto py-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="md:inline-flex items-center hidden">
                <Link href="/courses"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
                Courses
                </Link>
            </li>
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="hidden md:block w-6 h-6 text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <Link :href="`/courses/${chapter.course.slug}`"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                    {{ chapter.course.name }}</Link>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                        {{ chapter.name }}</span>
                </div>
            </li>
        </ol>
    </nav>


    <div class="h-96 grid items-center bg-cover bg-center rounded-b-3xl md:rounded-none shadow-lg shadow-black/20 mb-10"
        :style="`background-image: url('${chapter.thumbnail_url}');`
            ">
        <div
            class="border-s-4 border-yellow-400 pl-4 backdrop-blur-sm bg-black/50 w-full max-w-screen-xl px-4 mx-auto py-3">
            <p class="text-xs leading-tight tracking-tight text-yellow-400 md:text-sm mb-2">
                Chapter
            </p>
            <h2 class="text-white text-3xl md:text-5xl">{{ chapter.name }}</h2>
        </div>
    </div>
    <section class="bg-gray-50 dark:bg-gray-900 mb-24 max-w-screen-xl px-4 mx-auto">
        <div class=" grid md:grid-cols-2 gap-10">
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-sm lg:text-base dark:text-gray-400">
                {{ chapter.description }}
            </p>

            <video class="w-full h-auto max-w-full border border-gray-200 rounded-lg dark:border-gray-700" controls>
                <source :src="chapter.video" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </div>
        <p class="text-gray-500 dark:text-gray-400 my-4 text-sm">
            <Link :href="`/courses/${chapter.course.slug}`"
                class="inline-flex items-center font-medium text-blue-600 dark:text-gray-200 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>

            Back to Cource Home
            </Link>
        </p>

    </section>
</template>
<script>
export default {
    props: ['chapter']
}
</script>