<template>
</template>

<script>
import { onMounted, ref , beforeUnmount } from 'vue';

export default {
    mounted() {

        window.Echo.channel('task-channel')
            .listen('task.created', (e) => {
                console.log('task.created Received message:', e.message);
            });

        window.Echo.channel('task-channel')
            .listen('task.updated', (e) => {
                console.log('task.updated Received message:', e.message);
            });



    },
    // beforeUnmount() {

    //     window.Echo.leave('task-channel');

    // }
}

</script>