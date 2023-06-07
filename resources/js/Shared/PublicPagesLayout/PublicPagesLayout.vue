<template>
    <Header></Header>
    <slot></slot>
    <Footer></Footer>
</template>
<script setup>
import Header from './Components/Header.vue'
import Footer from './Components/Footer.vue'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>