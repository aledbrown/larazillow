<template>
    <div class="grid grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center">
            <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
                <img
                    class="rounded-md"
                    v-for="image in listing.images" :key="image.id"
                    :src="image.src"
                />
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">No images</div>
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
                    Monthly payment
                </template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%)</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input v-model.number="duration" type="range" min="3" max="35" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl font-bold" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div><Price :price="listing.price" class="font-medium" /></div>
                        </div>
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div><Price :price="totalInterest" class="font-medium" /></div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div><Price :price="totalPaid" class="font-medium" /></div>
                        </div>
                    </div>

                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3"
import ListingAddress from "@/Components/ListingAddress.vue"
import ListingSpace from "@/Components/ListingSpace.vue"
import Price from "@/Components/Price.vue"
import Box from "@/Components/UI/Box.vue"

import { ref, computed } from "vue"

import { useMonthlyPayment } from "@/Composables/useMonthlyPayment.js"

const interestRate = ref(2.5)
const duration = ref( 20)

const props = defineProps({
    listing: Object,
})

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration)
// const monthlyPayment = computed(() => {
//     const principle = props.listing.price
//     const monthlyInterest = interestRate.value / 100 / 12
//     const numberOfPaymentMonths = duration.value * 12
//     return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
// })
</script>
