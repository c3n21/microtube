<script setup lang="ts">
import VideoCard from "@/Components/VideoCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import type { Video } from "@/types/graphql";
import { Head } from "@inertiajs/vue3";

defineProps<{
    initialVideos: Video[];
}>();
</script>

<template>
    <Head title="Microtube" />
    <AuthenticatedLayout>
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div v-for="initialVideo in initialVideos" :key="initialVideo.id">
                <VideoCard :video="initialVideo" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
