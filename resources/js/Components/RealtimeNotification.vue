<template>
</template>

<script>
import { onMounted, ref  } from 'vue';
import { useToast } from 'primevue/usetoast';

export const RealtimeNotification = {
    mounted() {

        const toast = useToast();

        window.Echo.channel('task-channel')
            .listen('.task.created', (e) => {
                toast.add({
                    severity: 'info',
                    summary: 'Broadcast - Task Created',
                    detail: e.message,
                    life: 3000
                });

            }).error((err) => {
                console.error('Subscription error:', err);
            });

        window.Echo.channel('task-channel')
            .listen('.task.updated', (e) => {

                toast.add({
                    severity: 'info',
                    summary: 'Broadcast - Task Updated',
                    detail: e.message,
                    life: 3000
                });

            }).error((err) => {
                console.error('task.updated Subscription error:', err);
            });

            // window.Echo.channel('comment-task-channel')
            // .listen('.comment-task.created', (e) => {
            //     toast.add({
            //         severity: 'info',
            //         summary: 'Broadcast - Comment Task Created',
            //         detail: e.message,
            //         life: 3000
            //     });

            // }).error((err) => {
            //     console.error('Subscription error:', err);
            // });

            // window.Echo.channel('comment-task-channel')
            // .listen('.comment-task.updated', (e) => {

            //     toast.add({
            //         severity: 'info',
            //         summary: 'Broadcast - Comment Task Updated',
            //         detail: e.message,
            //         life: 3000
            //     });

            // }).error((err) => {
            //     console.error('task.updated Subscription error:', err);
            // });


    },
    beforeDestroy() {
        window.Echo.disconnect();
    }
}

</script>
