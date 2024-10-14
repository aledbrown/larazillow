<template>
    <div>Index using MainLayout this is working</div>
    <div>{{ message }}</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    message: String
})
</script>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";

export default {
    layout: MainLayout
}
</script>
