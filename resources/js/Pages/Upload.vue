<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useUploadVideoMutation } from "@/types/graphql";
import { Head, usePage } from "@inertiajs/vue3";

import { ref } from "vue";

const file = ref<File | null>(null);
const fileName = ref("");
const uploadResult = ref("");

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
    fileName.value = files[0].name; // Display the selected file name
};

const {
    props: {
        auth: { user },
    },
} = usePage();

// Function to trigger file upload
const uploadFile = () => {
    if (!file.value) {
        throw new Error("No file selected");
    }

    mutate({
        file: file.value, // Pass the file to the mutation
        title: "My video", // Pass the title to the mutation
        user_id: user.id.toString(),
    });
};
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
            <input type="file" @change="onFileSelected" />
            <button @click="uploadFile" :disabled="!file">Upload</button>
            <p v-if="fileName">Selected file: {{ fileName }}</p>
            <p v-if="uploadResult">Upload result: {{ uploadResult }}</p>
        </div>
    </AuthenticatedLayout>
</template>
