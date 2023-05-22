<template>
    <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ heading }}</h2>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">{{ subHeading }}</p>
      </div> 
      <div class="grid gap-8" :class="`lg:grid-cols-${columns}`">
        <Grid :posts="posts.data"></Grid>
      </div> 
      <div class="mx-auto max-w-screen-sm my-10">
      <PageNavigation :data="posts"></PageNavigation>

        </div> 

  </div>
</section>
</template>
<script>
export default {
    props:["posts","heading","subHeading","noColumn"],
    data() {
        return {
            columns : this.noColumn
        }
    },
}
</script>
<script setup>
import PageNavigation from '../../../Shared/PageNavigation.vue';
import Grid from '../../../Shared/Post/Grid.vue';
</script>