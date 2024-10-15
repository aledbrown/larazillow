<template>
    <Link :href="route('listing.index')">Listings</Link>&nbsp;
    <Link :href="route('listing.create')">New Listing</Link>

<!--    <div>The page with time is: {{ timer }}</div>-->
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
<!--    <div>{{ y }}</div>-->

    <slot></slot>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from "vue";

const page = usePage()
const flashSuccess = computed(
    () => page.props.flash.success,
)

// import { ref } from 'vue'
// const x = ref(5)
// const y = computed(() => x.value * 2)

// import { ref } from 'vue'
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
