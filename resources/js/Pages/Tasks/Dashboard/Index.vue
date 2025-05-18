<template>
    <Head title="Taks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <span class="flex flex-col lg:items-start">
                                <div class="relative w-50 lg:w-[500px] md:w-full">
                                    <div class="grid grid-cols-4 gap-4">
                                        <input type="text" v-model="searchStore.searchParams.code"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Code...">
                                        <input type="text" v-model="searchStore.searchParams.title"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title...">
                                        <select v-model="searchStore.searchParams.status" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                            <option value="" disabled>Select a status</option>
                                            <option v-for="status in statusList" :key="status.id" :value="status.id">
                                                {{ status.name }}
                                            </option>
                                        </select>

                                        <button type="submit" @click="searchStore.onSearch()" class="absolute right-0 bottom-0 outline-0 bg-blue text-gray-800 rounded-r-xl   text-xs px-4 py-3.5 uppercase font-semibold">SEARCH</button>
                                    </div>
                                </div>
                            </span>
                        </div>

                        <div class="overflow-x-auto shadow-xs sm:rounded-lg mt-5 px-2">
                            <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-lg">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Code</th>
                                    <th scope="col" class="px-5 py-3 text-center">Title</th>
                                    <th scope="col" class="px-5 py-3 mx-2 text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="item in results.data">
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.code }}</td>
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.title }}</td>
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.created_at }}</td>
                                        <td class="text-center font-medium w-46 text-sm ml-2 text-zinc-70 ">

                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div class="border-t mb-3 pt-3" v-if="results && results.data.length > 0">
                            <Pagination
                                :data="results"
                                :params="params"
                                class="mt-5 text-right">
                            </Pagination>
                        </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '../../../Components/Pagination.vue';
    import { Head } from '@inertiajs/vue3';
    import { useSearchStore } from '../../../States/useSearchStore';
    import { onMounted } from 'vue';
    import { computed } from 'vue';

    const props = defineProps({
        params: Object,
        results: Object,
        statusList: Object,
    });

    const searchStore = useSearchStore();

    onMounted(() => {
        searchStore.setRoute(route("tasks.dashboard"));
        searchStore.setInitialData(props.results);
    });

    const searchParams = computed(() => searchStore.searchParams);

</script>