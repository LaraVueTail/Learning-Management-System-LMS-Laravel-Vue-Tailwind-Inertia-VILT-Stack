<template>
    <!-- 
Install the "flowbite-typography" NPM package to apply styles and format the article content: 

URL: https://flowbite.com/docs/components/typography/ 
-->

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert"
            >
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div
                            class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"
                        >
                            <img
                                class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="Jese Leos"
                            />
                            <div>
                                <a
                                    href="#"
                                    rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white"
                                    >{{ $page.props.admin.name }}</a
                                >
                                <!-- <p
                                    class="text-base font-light text-gray-500 dark:text-gray-400"
                                >
                                    Graphic Designer, educator & CEO Flowbite
                                </p> -->
                                <p
                                    class="text-base font-light text-gray-500 dark:text-gray-400"
                                >
                                    <time
                                        pubdate
                                        datetime="2022-02-08"
                                        title="February 8th, 2022"
                                        >{{
                                            days[
                                                new Date(
                                                    post.created_at
                                                ).getDay()
                                            ] +
                                            ", " +
                                            new Date(
                                                post.created_at
                                            ).getDate() +
                                            " " +
                                            months[
                                                new Date(
                                                    post.created_at
                                                ).getMonth()
                                            ]
                                        }}</time
                                    >
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"
                    >
                        {{ post.head }}
                    </h1>
                </header>
                <p class="lead">
                    {{ post.sub_heading }}
                </p>
                <!-- <p>
                    Before going digital, you might benefit from scribbling down
                    some ideas in a sketchbook. This way, you can think things
                    through before committing to an actual design project.
                </p> -->

                <figure>
                    <img :src="post.thumbnail_url" alt="" />
                    <figcaption>Digital art by Anonymous</figcaption>
                </figure>
                <p v-html="post.text_content">
                </p>
            </article>
        </div>
    </main>
</template>
<script>
export default {
    props: ["post"],
    data() {
        return {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        }
    },
};
</script>
