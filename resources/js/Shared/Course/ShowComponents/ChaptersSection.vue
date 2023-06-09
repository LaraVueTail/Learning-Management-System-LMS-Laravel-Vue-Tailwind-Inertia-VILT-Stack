<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 mx-auto my-10 mb:my-24 xl:my-36">
            <h1 id="chapters"
                class="my-6 text-xl font-extrabold tracking-tight leading-none md:text-2xl xl:text-3xl dark:text-white text-center">
                Chapters
            </h1>

            <div class="my-2" v-for="chapter in chapters" :key="chapter">
                <div
                    class="max-w-2xl mx-auto items-center bg-gray-50 rounded-t-lg md:rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <Link href="#">
                    <img class="object-cover h-48 w-full max-w-48 rounded-t-lg sm:rounded-none sm:rounded-l-lg"
                        :src="chapter.thumbnail_url" alt="Bonnie Avatar" />
                    </Link>
                    <div class="p-5 max-w-lg">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">{{ chapter.name }}</a>
                        </h3>
                        <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400 text-sm">
                            {{ chapter.description }}
                        </p>
                        <Link
                            :href="enrolled ? `/course/${course.slug}/chapter/${chapter.slug}` : `/courses/${course.slug}/enroll`"
                            :method="enrolled ? '' : 'post'"
                            class="inline-flex items-center justify-center px-3 py-2 mr-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        {{ enrolled ? 'Start Learning' : 'Enroll Now' }}
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props: ["enrolled", "course", "chapters"]
}
</script>