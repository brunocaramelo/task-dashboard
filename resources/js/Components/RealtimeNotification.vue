<template>
  <Toast position="top-right" group="task-notifications" />
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

defineOptions({
  name: 'RealtimeNotification'
});

const toast = useToast();
let echoChannel = null;
const isConnected = ref(false);

const showNotification = (severity, summary, detail) => {
  toast.removeAllGroups();

  toast.add({
    severity,
    summary,
    detail: detail || 'Sem detalhes',
    life: 4000,
    group: 'task-notifications',
    closable: true
  });
};

const setupEcho = () => {
  if (!window.Echo) {
    console.warn('Echo if offline');
    return;
  }

  try {
    echoChannel = window.Echo.channel('task-channel');

    echoChannel.listen('.task.created', (e) => {
        showNotification('success', 'New Task', e.message);
      }).listen('.task.updated', (e) => {
        showNotification('info', 'Updated task', e.message);
      }).error((err) => {
        console.error('Erro no canal:', err);
        showNotification('error', 'Erro de Conexão', 'Falha no WebSocket');
        isConnected.value = false;
      });

    isConnected.value = true;
  } catch (error) {
    console.error('Erro ao configurar Echo:', error);
    showNotification('error', 'Erro de Configuração', 'Falha ao conectar ao WebSocket');
  }
};

onMounted(() => {
  setupEcho();
});

onBeforeUnmount(() => {
  if (echoChannel) {
    try {
      echoChannel.stopListening('.task.created');
      echoChannel.stopListening('.task.updated');
      echoChannel.stopListening('.task.deleted');
    } catch (error) {
      console.error('Erro ao remover listeners:', error);
    }
  }

  if (window.Echo) {
    try {
      window.Echo.disconnect();
    } catch (error) {
      console.error('Erro ao desconectar Echo:', error);
    }
  }

  toast.removeAllGroups();
  isConnected.value = false;
});
</script>
