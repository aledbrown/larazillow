<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing v-for="listing in listings" :key="listing.id" :listing="listing" />
    </div>
</template>

<script setup>
// import { Link } from "@inertiajs/vue3";
// import ListingAddress from "@/Components/ListingAddress.vue";
// import Box from "@/Components/UI/Box.vue";
// import ListingSpace from "@/Components/ListingSpace.vue";
// import Price from "@/Components/Price.vue";
import Listing from "@/Components/Listing.vue";

defineProps({
    listings: Array,
})
</script>
