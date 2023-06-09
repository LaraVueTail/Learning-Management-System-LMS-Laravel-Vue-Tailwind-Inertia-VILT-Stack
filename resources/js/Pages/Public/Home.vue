<template>
    <HeroSectionVue></HeroSectionVue>
    <FeaturesSection></FeaturesSection>
    <CallToActionSection></CallToActionSection>
</template>
<script>
export default {
    props: ["teachers"],
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import HeroSectionVue from '../../Shared/HomePageContents/HeroSection.vue';
import FeaturesSection from '../../Shared/HomePageContents/FeaturesSection.vue';
import CallToActionSection from '../../Shared/HomePageContents/CallToActionSection.vue';


// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
