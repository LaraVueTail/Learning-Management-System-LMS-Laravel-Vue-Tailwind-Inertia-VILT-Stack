<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full rounded-lg shadow-lg"
                src="https://images.pexels.com/photos/4143791/pexels-photo-4143791.jpeg" alt="dashboard image" />
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Join the LVTLearn Community Today!
                </h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                <ul class="list-disc mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    <li> Trusted by Institutions: LVTLearn has partnered with
                        renowned educational institutions worldwide, ensuring
                        credibility and quality in our courses.</li>
                    <li> Positive Student
                        Feedback: Thousands of satisfied learners have benefited
                        from LVTLearn's comprehensive learning resources, giving
                        us an average rating of 4.8 out of 5.</li>
                    <li> Secure and Reliable:
                        Your data privacy and security are our top priorities. Rest
                        assured that your personal information and progress are
                        protected within our encrypted systems.</li>
                    <!-- ... -->
                </ul>

                </p>
                <Link :href="$page.props.is_student_logged ? '/courses' : '/register'"
                    class="inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900">
                Get started
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                </Link>
            </div>
        </div>
    </section>
</template>
<script></script>
