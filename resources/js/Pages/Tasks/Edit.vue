<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import EditForm from './Parts/EditForm.vue';

    const dataToFillForm = defineProps({
        users: Array,
        statusList: Array,
        task: Object
    });

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Update Task" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <EditForm
                            :dataToFillForm="dataToFillForm"
                            :task="task"
                        />
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
