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
</script>
