<template>
    <footer class="p-4 bg-gray-100 md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <Link href="/" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
            <img :src="$page.props.app_url + 'Sitelogo/logo.svg'" class="mr-2 h-10 sm:h-10" alt="Logo" />
            LVTLearn
            </Link>
            <p class="my-6 text-gray-500 dark:text-gray-400">
                Welcome to LVTLearn! Discover a Revolutionary Learning
                Management System
            </p>
            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
                <li>
                    <Link href="/courses" class="mr-4 hover:underline md:mr-6">Courses</Link>
                </li>
                <li>
                    <Link href="/about" class="mr-4 hover:underline md:mr-6">About</Link>
                </li>
                <li>
                    <Link href="/contact" class="mr-4 hover:underline md:mr-6">Contact</Link>
                </li>
            </ul>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2021-2022 <a href="#"
                    class="hover:underline">LVTLearn™</a>.
                All Rights Reserved.</span>
        </div>
    </footer>
</template>
<script></script>
