<template>
    <span>
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city}}
    </span>
</template>

<script setup lang="ts">
defineProps({
    listing: Object
})
</script>
