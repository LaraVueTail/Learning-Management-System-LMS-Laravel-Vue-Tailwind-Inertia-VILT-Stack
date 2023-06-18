<template>
    <div class="bg-zinc-600 min-h-48 z-50">
        <div class="md:max-w-6xl py-10 mx-auto flex justify-between px-2 items-center">
            <div>
                <img :src="$page.props.app_url + 'Sitelogo/laravuetail-logo.png'" alt="" class="h-10 w-10">
                <p class="text-sm text-gray-100 font-poppins">
                    2023 &#169; <span class="text-[#ff2d20]">Lara</span><span class="text-[#41b883]">Vue</span><span
                        class="text-[#38bdf8]">Tail</span>
                </p>
                <p class="text-xs text-gray-100 font-poppins font-thin">
                    open source MIT license
                </p>
            </div>
            <div>
                <div
                    class="text-gray-100 font-poppins text-sm cursor-pointer hover:text-white space-x-3 grid justify-items-end md:justify-items-start md:grid-cols-3">
                    <a href="https://laravuetail.com" class="hover:underline">Projects</a>
                    <a href="https://laravuetail.com/about" class="hover:underline">About</a>
                    <a href="https://github.com/LaraVueTail" class="hover:underline">Github
                        <i class="fa-brands ml-1 fa-github text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>
<script></script>