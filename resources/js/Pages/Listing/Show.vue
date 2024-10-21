<template>
    <div class="grid grid-cols-12 gap-4">
        <Box class="col-span-12 md:col-span-7 flex items-center">
            <div class="w-full text-center font-medium text-gray-500">No images</div>
        </Box>
        <div class="order-first md:order-none col-span-12 md:col-span-5">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box class="mt-4">
                <template #header>
                    Offer
                </template>
                Making an offer
            </Box>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
defineProps({
    listing: Object
})
</script>
