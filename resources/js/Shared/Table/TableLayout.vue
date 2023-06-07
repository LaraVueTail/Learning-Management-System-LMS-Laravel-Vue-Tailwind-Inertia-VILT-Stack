<template>
      <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200 dark:border-gray-700 my-4 max-w-6xl"
    >
    <slot></slot>
    </div>  
</template>
<script>
export default {
    props:["tableWidth"],
    computed:{
        width(){
            return 'max-w-'+this.tableWidth
        }
    }
}
</script>