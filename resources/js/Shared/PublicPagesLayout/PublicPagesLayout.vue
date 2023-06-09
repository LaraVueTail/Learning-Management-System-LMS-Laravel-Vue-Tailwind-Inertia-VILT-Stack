<template>
    <LVTHeader :projectName="'Learning Management System(LMS)'"></LVTHeader>
    <slot></slot>
    <LVTFooter></LVTFooter>
</template>
<script setup>
import LVTHeader from './LVTComponents/LVTHeader.vue'
import LVTFooter from './LVTComponents/LVTFooter.vue'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>