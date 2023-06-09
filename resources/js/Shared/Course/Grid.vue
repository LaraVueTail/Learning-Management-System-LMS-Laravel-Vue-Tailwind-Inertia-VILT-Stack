<template>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <GridSingle
            v-for="dataItem in data"
            :key="dataItem"
            :dataItem="dataItem"
        >
        </GridSingle>
    </div>
</template>
<script>
export default {
    props: ["data"],
};
</script>
<script setup>
import GridSingle from "./GridComponents/GridSingle.vue";
</script>
