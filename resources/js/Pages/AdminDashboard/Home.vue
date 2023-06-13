<template>
    <div class="px-4">
        <p class="text-2xl text-gray-600">Welcome to Dashboard.</p>
    </div>
</template>
<script>
</script>
<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>