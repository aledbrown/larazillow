<template>
    <span>
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city}}, &pound;{{ listing.price }}
    </span>
</template>

<script setup lang="ts">
defineProps({
    listing: Object
})
</script>
