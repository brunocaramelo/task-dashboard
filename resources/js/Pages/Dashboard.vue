<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="overflow-x-auto shadow-xs sm:rounded-lg mt-5 px-2">

                        <h1>Last created tasks</h1>

                        <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-lg">
                            <tr>
                                <th scope="col" class="px-5 py-3">Code</th>
                                <th scope="col" class="px-5 py-3 text-center">Title</th>
                                <th scope="col" class="px-5 py-3 text-center">Status</th>
                                <th scope="col" class="px-5 py-3 mx-2 text-center">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in lastsTasks.data">
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="text-center font-medium text-lg text-zinc-700">{{ item.code }}</td>
                                    <td class="text-center font-medium text-lg text-zinc-700">{{ item.title }}</td>
                                    <td class="text-center font-medium text-lg text-zinc-700">{{ item.status.name }}</td>
                                    <td class="text-center font-medium text-lg text-zinc-700">{{ item.created_at }}</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 40px">
                    <h3>Reconciled data</h3>
                    <div class="grid grid-cols-3 gap-3" style="margin-top: 20px">
                        <template v-for="counter in counters">
                            <div>
                                <h5>{{ counter.name }}</h5>
                                <div>
                                    {{ counter.total }}
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        lastsTasks: Object,
        counters: Object
    });
</script>