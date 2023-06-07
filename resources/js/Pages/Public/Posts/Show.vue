<template>
    <Single :post="post"></Single>
</template>
<script>
export default {
    props:["post"]
}
</script>
<script setup>
import Single from "../../../Shared/Post/Single.vue";
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
