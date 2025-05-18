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
                                    <div class="grid grid-cols-3 gap-3">
                                        <input type="text" v-model="searchStore.searchParams.code" @blur="searchStore.onSearch()"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Code...">
                                        <input type="text" v-model="searchStore.searchParams.title" @blur="searchStore.onSearch()"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title...">
                                        <select v-model="searchStore.searchParams.status" @change="searchStore.onSearch()" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                            <option value="" disabled>Select a status</option>
                                            <option v-for="status in statusList" :key="status.id" :value="status.id">
                                                {{ status.name }}
                                            </option>
                                        </select>
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
                                    <th scope="col" class="px-5 py-3 text-center">Status</th>
                                    <th scope="col" class="px-5 py-3 mx-2 text-center">
                                        <a href="#" @click.prevent="toggleOrderDate" class="toggle-link">
                                            {{ isToggled.value ? '&uparrow;' : '&downarrow;' }}
                                        </a> Created At</th>
                                    <th scope="col" class="px-5 py-3 mx-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="item in results.data">
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.code }}</td>
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.title }}</td>
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.status.name }}</td>
                                        <td class="text-center font-medium text-lg text-zinc-700">{{ item.created_at }}</td>
                                        <td class="text-center font-medium w-46 text-sm ml-2 text-zinc-70">
                                            <a @click="gotoEditItem(item.id)">
                                                <img src="https://unpkg.com/lucide-static@latest/icons/pencil.svg" alt="Edit">
                                            </a>
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

        <div class="fixed bottom-4 right-4">
            <a @click="gotoNewItem()" class="cursor-pointer bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-full shadow-lg p-6 transition-colors duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle">
                    <circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
            </a>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '../../../Components/Pagination.vue';
    import { Head, router } from '@inertiajs/vue3';
    import { useSearchStore } from '../../../States/useSearchStore';
    import { onMounted , computed, ref } from 'vue';

    const props = defineProps({
        params: Object,
        results: Object,
        statusList: Object,
    });

    const searchStore = useSearchStore();
    const searchParams = computed(() => searchStore.searchParams);
    const isToggled = ref(true);

    onMounted(() => {
        searchStore.setRoute(route("tasks.dashboard"));
        searchStore.setInitialData(props.results);
    });

    const toggleOrderDate = () => {
      isToggled.value = !isToggled.value;
      searchStore.searchParams.order_sense = (isToggled.value ? 'DESC' : 'ASC')
      searchStore.searchParams.order_field = 'tasks.created_at'

      searchStore.onSearch();
    }

</script>