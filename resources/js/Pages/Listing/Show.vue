<template>
    <Link :href="`/listing`">Back</Link>
    <div>Listing</div>
    <ListingAddress :listing="listing" />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
defineProps({
    listing: Object
})
</script>
