<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";

interface Props {
    src: string;
}

const props = defineProps<Props>();

const videoPlayer = ref<HTMLVideoElement | null>(null);
const isPlaying = ref(false);
const progress = ref(0);

// Play/Pause toggle method
const togglePlay = () => {
    if (videoPlayer.value) {
        if (videoPlayer.value.paused) {
            videoPlayer.value.play();
            isPlaying.value = true;
        } else {
            videoPlayer.value.pause();
            isPlaying.value = false;
        }
    }
};

// Update progress bar
const updateProgress = () => {
    if (videoPlayer.value) {
        progress.value =
            (videoPlayer.value.currentTime / videoPlayer.value.duration) * 100;
    }
};

// Seek to a position in the video when the progress bar is clicked
const seek = (event: MouseEvent) => {
    if (videoPlayer.value) {
        const progressBar = event.currentTarget as HTMLDivElement;
        const clickPosition =
            (event.pageX - progressBar.offsetLeft) / progressBar.offsetWidth;
        videoPlayer.value.currentTime =
            clickPosition * videoPlayer.value.duration;
    }
};

// Reset play state when video ends
const onVideoEnd = () => {
    isPlaying.value = false;
};

onMounted(() => {
    if (videoPlayer.value) {
        videoPlayer.value.addEventListener("timeupdate", updateProgress);
        videoPlayer.value.addEventListener("ended", onVideoEnd);
    }
});
</script>

<template>
    <Head title="Play" />
    <div class="video-player">
        <p>stronzo</p>
        <video ref="videoPlayer" :src="props.src" controls></video>
        <div class="controls">
            <button @click="togglePlay">
                {{ isPlaying ? "Pause" : "Play" }}
            </button>
            <div class="progress-bar" @click="seek">
                <div class="progress" :style="{ width: progress + '%' }"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.video-player {
    max-width: 800px;
    margin: 0 auto;
}
.controls {
    display: flex;
    align-items: center;
    margin-top: 10px;
}
.progress-bar {
    flex-grow: 1;
    height: 10px;
    background: #ccc;
    position: relative;
    cursor: pointer;
    margin-left: 10px;
}
.progress {
    height: 100%;
    background-color: #2196f3;
    width: 0;
}
</style>
