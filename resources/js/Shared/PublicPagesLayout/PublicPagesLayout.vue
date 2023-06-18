<template>
    <Notification></Notification>
    <LVTHeader :projectName="'LVTLearn'"></LVTHeader>
    <Header></Header>
    <div class="bg-gray-50 dark:bg-gray-900">
        <slot></slot>

    </div>
    <Footer></Footer>
    <LVTFooter></LVTFooter>
</template>
<script setup>
import LVTHeader from './LVTComponents/LVTHeader.vue'
import LVTFooter from './LVTComponents/LVTFooter.vue'
import Notification from '../AdminDashboardLayout/components/Notification.vue';


import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from './Components/Header.vue'
import Footer from './Components/Footer.vue'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>