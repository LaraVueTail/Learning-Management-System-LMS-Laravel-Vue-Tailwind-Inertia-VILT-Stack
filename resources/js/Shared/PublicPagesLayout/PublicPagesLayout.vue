<template>
    <Header></Header>
    <slot></slot>
    <Footer></Footer>
</template>
<script setup>
import Header from './Components/Header.vue'
import Footer from './Components/Footer.vue'
</script>