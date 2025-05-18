import { defineStore } from 'pinia'
import { ref } from 'vue'
import { z } from 'zod';

export const useUpdateTaskStore = defineStore('createTask', () => {

    const processing = ref(false);

    const dataToSend = ref({
        title: null,
        rapporteur_id: null,
        responsible_id: null,
        description: null,
        status_id: null,
    });

    const responseSuccess = ref(null);
    const errorsResponse = ref([]);

    const routeSuccess = ref('');
    const routeName = ref('');
    const csrfToken = ref('');

    const setRoute = (name) => {
        routeName.value = name;
    };

    const setRouteSuccess = (name) => {
        routeSuccess.value = name;
    };

    const setInitialData = (data) => {
        dataToSend.value.title = data.title;
        dataToSend.value.rapporteur_id = data.rapporteur_id;
        dataToSend.value.responsible_id = data.responsible_id;
        dataToSend.value.description = data.description;
        dataToSend.value.status_id = data.status_id;
    };

    const setCsrfToken = (name) => {
        csrfToken.value = name;
    };

    const dataSchemaValidator = z.object({
        title: z.string().min(5),
        rapporteur_id: z.number(),
        responsible_id: z.number(),
        status_id: z.number(),
        description: z.string().min(5),
    });

    const validateForm = () => {

      let validateReturn = {status: 'success', errors: []}

      try {

        dataSchemaValidator.parse(dataToSend.value);

        return validateReturn;

    } catch (error) {

        error.issues.forEach(issue => {
            const index = issue.path.length - 1;
            validateReturn.errors[issue.path[index]] = issue.message;
        });

        validateReturn.status = 'fail';

        return validateReturn;
      }

    };

    const onSubmit = async () => {
        processing.value = true;

        const validateThisForm = validateForm();

        if(validateThisForm.status == 'fail') {
            errorsResponse.value = validateThisForm.errors;
            return false;
        }

        try {
            const response = await fetch(routeName.value, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.value
                },
                body: JSON.stringify(dataToSend.value),
            });

            if (!response.ok) {
                const errorData = await response.json();
                errorsResponse.value = errorData.errors;

                console.error('Erro da API:', errorData);
            }

            const data = await response.json();
            responseSuccess.value = data;

        } catch (error) {
            console.error('Erro:', error);
        } finally {
            processing.value = false;
        }
    };

    return {
        dataToSend,
        setRoute,
        setRouteSuccess,
        setCsrfToken,
        setInitialData,
        onSubmit,
        responseSuccess,
        errorsResponse,
    };
});