<script setup lang="ts">
import { Video } from "@/types/graphql";

interface VideoCardProps {
    video: Video;
}
defineProps<VideoCardProps>();
</script>

<template>
    <div class="video-card">
        <div class="video-card-header">
            <h3>
                <a :href="`/video/${video.id}`">
                    {{ video.title }}
                </a>
            </h3>
        </div>
        <div class="video-card-body">
            <p><strong>Uploaded by:</strong> {{ video.user.name }}</p>
            <p><strong>Uploaded at:</strong> {{ video.uploaded_at }}</p>
        </div>
    </div>
</template>

<style scoped>
.video-card {
    border: 1px solid #ccc;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.video-card-header h3 {
    margin: 0;
    font-size: 1.5rem;
}

.video-card-body p {
    margin: 5px 0;
    font-size: 1rem;
}

.video-card-body p strong {
    color: #333;
}
</style>
