<template>
    <div class="container pt-5">
        <div class="d-flex justify-content-between mb-3">
            <h4>List of URLs:</h4>
            <a class="btn btn-primary" href="url/create">Create URL</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Shortened URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="url in urls" :key="url.id">
                        <td>{{ url.name }}</td>
                        <td>
                            <a :href="url.url" target="_blank">{{ url.url }}</a>
                        </td>
                        <td>
                            <a :href="url.url" target="_blank">{{ url.shortened_url }}</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info me-2" :href="`/url/edit/${url.id}`">Edit</a>
                            <Link class="btn btn-sm btn-danger" @click="confirmDelete(url.id)">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="successMessage" class="alert alert-success mt-3">{{ successMessage }}</div>
    </div>
</template>

<script setup>
    import { defineProps, ref, watch } from 'vue';
    import { Link, router } from '@inertiajs/vue3';

    const props = defineProps({
        urls: Object,
        success: String
    });

    const successMessage = ref(props.success || '');

    watch(() => props.success, (newValue) => {
        successMessage.value = newValue;
    });

    successMessage.value = props.success;

    const confirmDelete = (id) => {
        if (confirm("Are you sure you want to delete this URL?")) {
            router.delete(`/url/delete/${id}`);

            successMessage.value = 'URL deleted successfully.';
        }
    };
</script>