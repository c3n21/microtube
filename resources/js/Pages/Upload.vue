<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useUploadVideoMutation } from "@/types/graphql";
import { Head, usePage } from "@inertiajs/vue3";

import { ref } from "vue";

const file = ref<File | null>(null);
const uploadResult = ref("");
const fileNameInput = ref("");

const { mutate } = useUploadVideoMutation();

// Watch for file input changes
const onFileSelected = (event: Event) => {
    if (!(event.target instanceof HTMLInputElement)) {
        throw new Error("No files selected");
    }

    const files = event.target.files;

    if (!files || 0 >= files.length) {
        throw new Error("No files selected");
    }

    file.value = files[0];
    fileNameInput.value = files[0].name; // Display the selected file name
};

const {
    props: {
        auth: { user },
    },
} = usePage();

// Function to trigger file upload
function uploadFile() {
    if (!file.value) {
        throw new Error("No file selected");
    }

    mutate({
        file: file.value, // Pass the file to the mutation
        title: fileNameInput.value, // Pass the title to the mutation
        user_id: user.id.toString(),
    }).then((response) => {
        const createdVideo = response?.data?.createVideo;
        if (createdVideo) {
            uploadResult.value = `Uploaded video '${createdVideo.title}' with '${createdVideo.id}' as id`;
        }
        throw new Error("Failed to upload the file");
    });
}
</script>

<template>
    <Head title="Upload" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Upload your video
            </h2>
        </template>

        <div class="py-12">
            <input v-if="file" type="text" v-model="fileNameInput" />
            <input type="file" @change="onFileSelected" accept="video/*" />
            <button type="submit" @click="uploadFile" :disabled="!file">
                Upload
            </button>
        </div>
    </AuthenticatedLayout>
</template>
