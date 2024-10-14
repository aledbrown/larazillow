<template>
    <MainLayout>
        <div>Index using MainLayout this is working</div>
        <div>{{ message }}</div>
    </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import MainLayout from "../../Layouts/MainLayout.vue";
defineProps({
    message: String
})
</script>
