<template>
    <Notification></Notification>
    <NavSidebar :siteLogo="$page.props.app_url + 'Sitelogo/logo.svg'" :siteName="'LVTLearn'"
        :userAvatar="$page.props.admin_user.avatar_url" :userName="$page.props.admin_user.full_name"
        :userEmail="$page.props.admin_user.email" :navMenu="navMenu" :sidebarMenu="sidebarMenu">
        <div class="md:px-4 py-4 sm:ml-64 dark:bg-gray-900">
            <div class="px-2 md:px-4  pt-4 pb-32 mt-14 min-h-screen">
                <slot></slot>
            </div>
        </div>
    </NavSidebar>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import NavSidebar from "./components/NavSidebar.vue";
// import Sidebar from "./components/Sidebar.vue";
import Notification from "./components/Notification.vue";
import {
    ChartPieIcon,
    CogIcon,
    ArrowRightOnRectangleIcon,
    DocumentTextIcon,
    UserCircleIcon,
    BookOpenIcon,
    BookmarkIcon,
    UserGroupIcon,
    Cog6ToothIcon
} from "@heroicons/vue/24/solid";
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
                    name: "Dashboard",
                    link: "/admin-dashboard",
                    method: "get",
                },
                {
                    name: "Profile Info",
                    link: "/admin-dashboard/profile-info",
                    method: "get",
                },
                {
                    name: "Sign out",
                    link: "/logout",
                    method: "post",
                    as: "button", type: "button",

                },
            ],
            sidebarMenu: [
                {
                    name: "Dashboard",
                    link: "/admin-dashboard",
                    method: "get",
                    icon: ChartPieIcon,
                },
                {
                    name: "Teachers",
                    link: "/admin-dashboard/teachers",
                    method: "get",
                    hideIf: !this.$page.props.is_admin_logged,
                    icon: UserCircleIcon,
                    subMenu: [
                        {
                            name: "Create",
                            link: "/admin-dashboard/teachers/create",
                        },
                        {
                            name: "All Teachers",
                            link: "/admin-dashboard/teachers",
                        },
                    ],
                },
                {
                    name: "Courses",
                    link: "/admin-dashboard/courses",
                    method: "get",
                    icon: BookOpenIcon,
                    hideIf: !this.$page.props.is_teacher_logged_has_course,
                    subMenu: [
                        {
                            name: "Create",
                            hideIf: !this.$page.props.is_admin_logged,
                            link: "/admin-dashboard/courses/create",
                        },
                        {
                            name: "All Courses",
                            link: "/admin-dashboard/courses",
                        },
                    ],
                },
                {
                    name: "Chapters",
                    link: "/admin-dashboard/chapters",
                    method: "get",
                    icon: BookmarkIcon,
                    hideIf: !this.$page.props.is_teacher_logged_has_course,
                    subMenu: [
                        {
                            name: "Create",
                            link: "/admin-dashboard/chapters/create",
                        },
                        {
                            name: "All Chapters",
                            link: "/admin-dashboard/chapters",
                        },
                    ],
                },
                {
                    name: "Students",
                    link: "/admin-dashboard/students",
                    method: "get",
                    hideIf: !this.$page.props.is_admin_logged,
                    icon: UserGroupIcon,
                    subMenu: [
                        {
                            name: "Create",
                            link: "/admin-dashboard/students/create",
                        },
                        {
                            name: "All Students",
                            link: "/admin-dashboard/students",
                        },
                    ],
                },
                {
                    name: "Personal Info",
                    link: "/admin-dashboard/profile-info",
                    method: "get",
                    icon: Cog6ToothIcon,
                },
                {
                    name: "Sign out",
                    link: "/logout",
                    method: "post",
                    as: "button", type: "button",
                    icon: ArrowRightOnRectangleIcon,
                },
            ],
        };
    },
};
</script>
