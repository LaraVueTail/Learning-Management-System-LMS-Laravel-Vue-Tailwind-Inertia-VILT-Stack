<template>
    <HeroSection></HeroSection>
    <Courses :heading="'Courses'" :data="courses"></Courses>

</template>
<script>
export default {
    props:['courses']
}
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import HeroSection from '../../Shared/CoursesPageContents/HeroSection.vue';
import Courses from "./Course/Index.vue";
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>