<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
            <div class="lg:hidden mb-6 rounded-b-3xl shadow-xl shadow-black/50">
                <div :style="`background-image:url('${course.thumbnail_url}')`" alt="mockup"
                    class="w-full h-96 bg-cover bg-center rounded-b-3xl"></div>
            </div>

            <div class="mr-auto place-self-center lg:col-span-7 mb-10">
                <p class="max-w-2xl mb-2 font-medium text-gray-500 lg:mb-3 md:text-sm lg:text-sm dark:text-gray-400">
                    Course
                </p>
                <h1
                    class="max-w-2xl mb-4 text-xl font-extrabold tracking-tight leading-none md:text-4xl xl:text-5xl dark:text-white">
                    {{ course.name }}
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-sm lg:text-base dark:text-gray-400">
                    {{ course.short_description }}
                </p>
                <Link
                    :href="enrolled ? `/course/${course.slug}/chapter/${firstChapter.slug}` : `/courses/${course.slug}/enroll`"
                    :method="enrolled ? '' : 'post'"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                {{ enrolled ? 'Start Learning' : 'Enroll Now' }}
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                </Link>
                <a href="#chapters"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    See Chapters
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex rounded-b-3xl shadow-2xl shadow-black">
                <img :src="course.thumbnail_url" alt="mockup" class="rounded-b-3xl" />
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props: ["course", "enrolled", "firstChapter"]
}
</script>