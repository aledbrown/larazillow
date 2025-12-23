<template>
    <Box class="mb-4">
        <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
            <div :class="{ 'opacity-25': listing.deleted_at }">
                <div class="xl:flex items-center gap-2">
                    <Price :price="listing.price" class="text-2xl font-medium" />
                    <ListingSpace :listing="listing" />
                </div>
                <ListingAddress :listing="listing" />
            </div>
            <section>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                    <a class="btn-outline text-xs font-medium" :href="route('listing.show', { listing: listing.id })" target="_blank">Preview</a>
                    <Link class="btn-outline text-xs font-medium" :href="route('agent.listing.edit', { listing: listing.id })">Edit</Link>
                    <Link v-if="!listing.deleted_at" class="btn-outline text-xs font-medium" :href="route('agent.listing.destroy', { listing: listing.id })" as="button" method="delete">
                        Delete
                    </Link>
                    <Link v-else class="btn-outline text-xs font-medium" :href="route('agent.listing.restore', { listing: listing.id })" as="button" method="put">
                        Restore
                    </Link>
                </div>
            </section>
        </div>
    </Box>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                       type="file" multiple @input="addFiles"/>
                <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                        :disabled="!canUpload">
                    Upload
                </button>
                <button type="reset" class="btn-outline" @click="reset">
                    Reset
                </button>
            </section>
            <div v-if="imageErrors.length" class="input-error">
                <div v-for="(error, index) in imageErrors" :key="index">
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Listing Images</template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="image.src" class="rounded-md" />
                <Link :href="route('agent.listing.image.destroy', { listing: props.listing.id, image: image.id })" method="delete" as="button" class="mt-2 btn-outline text-xs">
                    Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/vue3'
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import ListingAddress from "@/Components/ListingAddress.vue";

const props = defineProps({ listing: Object })

const form = useForm({
    images: [],
})

const imageErrors = computed(() => Object.values(form.errors))

const canUpload = computed(() => form.images.length)

const upload = () => {
    form.post(
        route('agent.listing.image.store', { listing: props.listing.id }),
        {
            onSuccess: () => {
                // console.log("tried to reset form");
                form.reset('images');
            },
        },
    )
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image)
    }
}

const reset = () => form.reset('images')
</script>
