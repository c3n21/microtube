<template>
    <div>
        <video ref="videoRef" class="video-js">
            <source :src="$props.src" type="video/mp4" />
        </video>
    </div>
</template>

<script setup lang="ts">
import videojs from "video.js";
import type Player from "video.js/dist/types/player";
import { onMounted, onUnmounted, ref, useTemplateRef } from "vue";
const videoRef = useTemplateRef("videoRef");
const player = ref<Player | null>(null);

type Props = {
    src: string;
};

defineProps<Props>();

onMounted(() => {
    if (!videoRef.value) {
        return;
    }
    player.value = videojs(videoRef.value, {
        autoplay: true,
        controls: true,
    });
});

onUnmounted(() => {
    player?.value?.dispose();
});
</script>
