<template>
    <GridSingle v-for="post in posts" :key="post" :post="post">
    </GridSingle>
</template>
<script>
export default {
    props:["posts"]
}
</script>
<script setup>
import GridSingle from './GridComponents/GridSingle.vue'
</script>