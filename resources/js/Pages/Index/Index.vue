<template>
     <div>
        <Link href="/hello">Show Page</Link>
        <h1>This is {{message}}</h1>
    </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
// import MainLayout from '../../Layouts/MainLayout.vue'
defineProps(['message'],{message : string})
</script>
