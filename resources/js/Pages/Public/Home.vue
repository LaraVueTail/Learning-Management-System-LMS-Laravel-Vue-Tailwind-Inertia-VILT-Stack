<template>
    <Hero></Hero>
    <Posts :noColumn="2" :heading="'Our Blog'" :subHeading="'This is sub Heading'" :posts="posts"></Posts>
</template>
<script>
export default {
    props:["posts"]
}
</script>
<script setup>
import Hero from '../../Shared/HomePageContents/Hero.vue'
import Posts from './Posts/Index.vue';
</script>