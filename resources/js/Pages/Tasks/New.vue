<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import CreateForm from './Parts/CreateForm.vue';

    const dataToFillForm = defineProps({
        users: Array,
        statusList: Array
    });

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Register Task" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <CreateForm
                            :dataToFillForm="dataToFillForm"
                        />
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
