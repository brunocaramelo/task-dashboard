<template>
            <div class="row">
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="formCreateStore.dataToSend.title"
                            required
                            autofocus
                            autocomplete="title"
                        />
                        <InputError class="mt-2" :message="formCreateStore.errorsResponse?.title" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="rapporteur" value="Rapporteur" />
                        <select v-model="formCreateStore.dataToSend.rapporteur_id" id="rapporteur" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="" disabled>Select a user</option>
                            <option v-for="user in dataToFillForm.users.data" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="formCreateStore.errorsResponse?.rapporteur_id" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="responsible" value="Responsible" />
                        <select v-model="formCreateStore.dataToSend.responsible_id" id="responsible" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="" disabled>Select a user</option>
                            <option v-for="user in dataToFillForm.users.data" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="formCreateStore.errorsResponse?.responsible_id" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="status_id" value="Status" />
                        <select v-model="formCreateStore.dataToSend.status_id" id="status_id" class="g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="" disabled>Select a user</option>
                            <option v-for="user in dataToFillForm.statusList.data" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="formCreateStore.errorsResponse?.status_id" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Description" />
                        <Textarea v-model="formCreateStore.dataToSend.description" rows="5" cols="30" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 " />

                        <InputError class="mt-2" :message="formCreateStore.errorsResponse?.description" />
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4 border-black"
                    :disabled="formCreateStore.processing"
                    @click="formCreateStore.onSubmit()"
                >
                    Send
                </PrimaryButton>
            </div>
        </div>


<Toast />

</template>

<script setup>
    import { watch} from 'vue'
    import InputError from '@/Components/InputError.vue';
    import { Link , router} from '@inertiajs/vue3'
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { useCreateStoreStore } from '../../../States/useCreateTaskStore';
    import { useToast } from 'primevue/usetoast';
    import Toast from 'primevue/toast';

    const toast = useToast();

    const props = defineProps({
        dataToFillForm: Object,
        csrfToken: String
    });

    const formCreateStore = useCreateStoreStore();

    formCreateStore.setRoute(route("tasks.send-create"));
    formCreateStore.setCsrfToken(props.csrfToken);

    watch( () => formCreateStore.responseSuccess, (newValue) => {
            if (newValue && newValue.status == 'success') {

                toast.add({
                    severity: 'success',
                    summary: 'You Created a Task',
                    detail: 'Task ['+newValue.data.code+'] Created!..Redirecting',
                    life: 3000
                });

                setTimeout(() => {
                    router.visit(route("tasks.dashboard"));
                }, "2000");
            }
        },
        { deep: true }
    );


</script>