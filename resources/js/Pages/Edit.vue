<template>
    <div class="container pt-5">
        <h4>Edit URL</h4>
        <form @submit.prevent="form.put(`/url/update/${url.id}`)" class="mt-3">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" v-model="form.name" class="form-control" />
                <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" id="url" v-model="form.url" class="form-control" />
                <div v-if="form.errors.url" class="text-danger">{{ form.errors.url }}</div>
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary me-2" href="javascript:history.back()">Back</a>
                <input type="submit" value="Update URL" class="btn btn-primary" />
            </div>
        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { defineProps } from 'vue';

    let props = defineProps({
        url: Object
    })
    
    const form = useForm({
        name: props.url.name,
        url: props.url.url
    })

</script>