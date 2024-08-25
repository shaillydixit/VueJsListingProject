<template>
  <div class="flex gap-1">
    <Link 
      v-for="(link, index) in links" 
      :key="index" 
      :href="link.url" 
      :class="[
        'py-2 px-4 rounded-md', 
        link.active ? 'bg-indigo-500 dark:bg-indigo-800 text-gray-300' : ''
      ]">
      {{ link.label }}
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    required: true
  }
})
</script>
