<template>
    <LVTHeader :projectName="'LMS'"></LVTHeader>
    <Header></Header>
    <slot></slot>
    <Footer></Footer>
    <LVTFooter></LVTFooter>
</template>
<script setup>
import LVTHeader from './LVTComponents/LVTHeader.vue'
import LVTFooter from './LVTComponents/LVTFooter.vue'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from './Components/Header.vue'
import Footer from './Components/Footer.vue'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>