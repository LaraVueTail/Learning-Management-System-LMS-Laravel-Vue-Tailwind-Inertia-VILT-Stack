<template>
    <Hero></Hero>
    <!-- <Posts :noColumn="2" :heading="'Blog Posts'" :subHeading="'Checkout our sample posts.'" :posts="posts"></Posts> -->
</template>
<script>
export default {
    props:["posts"]
}
</script>
<script setup>
import Hero from '../../Shared/HomePageContents/Hero.vue'
import Posts from './Posts/Index.vue';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>