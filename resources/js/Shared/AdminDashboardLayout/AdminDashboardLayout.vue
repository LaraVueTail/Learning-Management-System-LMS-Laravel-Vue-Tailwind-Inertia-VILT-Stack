<template>
    <Notification></Notification>
    <Navbar :siteLogo="'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg'" :siteName="'Flowbite'"
        :userAvatar="'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg'" :userName="'Ameerali C'"
        :userEmail="'example@email.com'" :navMenu="navMenu"></Navbar>
    <Sidebar :sidebarMenu="sidebarMenu"></Sidebar>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14 min-h-screen">
            <slot></slot>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Navbar from "./Components/Navbar.vue";
import Sidebar from "./Components/Sidebar.vue";
import Notification from "./Components/Notification.vue";
import { ChartPieIcon,CogIcon,ArrowRightOnRectangleIcon,DocumentTextIcon } from "@heroicons/vue/24/solid"
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
<script>
export default {
    data() {
        return {
            navMenu: [
                {
                    name: 'Dashboard',
                    link: '/admin-dashboard',
                    method: 'get',
                },
                {
                    name: 'Settings',
                    link: '/admin-dashboard/settings',
                    method: 'get',
                },
                {
                    name: 'Sign out',
                    link: '/logout',
                    method: 'post',
                }
            ],
            sidebarMenu: [
                {
                    name: 'Dashboard',
                    link: '/admin-dashboard',
                    method: 'get',
                    icon: ChartPieIcon,
                },
                {
                    name: 'Posts',
                    link: '/admin-dashboard/posts',
                    method: 'get',
                    icon: DocumentTextIcon,
                    subMenu: [
                        {
                            name:'Create New Post',
                            link:'/admin-dashboard/posts/create',
                        },
                        {
                            name:'All Posts',
                            link:'/admin-dashboard/posts',
                        }
                    ]
                },
                {
                    name: 'Sign out',
                    link: '/logout',
                    method: 'post',
                    icon: ArrowRightOnRectangleIcon

                }
            ]
        }
    },
}
</script>
