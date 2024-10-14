<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link href="/">Main Page</Link>&nbsp;
    <Link href="/hello">Show Page</Link>
    <slot></slot>
</template>

<style scoped>

</style>
