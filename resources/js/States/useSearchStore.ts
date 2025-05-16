import { defineStore } from 'pinia'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

export const useSearchStore = defineStore('search', () => {
    const searchParams = ref({
        status: '',
        title: '',
        code: '',
    });

    const routeName = ref('');
    const results = ref('');

    const setRoute = (name) => {
        routeName.value = name;
    };

    const setInitialData = (name) => {
        results.value = name;
    };


    const onSearch = () => {
        router.get(routeName.value, searchParams.value);
    };

    return {
        searchParams,
        setRoute,
        setInitialData,
        onSearch,
    };
});