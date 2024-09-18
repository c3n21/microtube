<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

import { ref } from "vue";

// GraphQL mutation for file upload

// Reactive properties
const file = ref(null);
const fileName = ref("");
const uploadResult = ref("");

// Watch for file input changes
const onFileSelected = (event) => {
    const files = event.target.files;
    if (files && files.length > 0) {
        file.value = files[0]; // Store the selected file
        fileName.value = files[0].name; // Display the selected file name
    }
};

// Function to trigger file upload
const uploadFile = () => {
    if (file.value) {
        mutate({
            file: file.value, // Pass the file to the mutation
        });
    }
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
