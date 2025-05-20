import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config'
import 'primevue/resources/themes/lara-light-indigo/theme.css'
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'
import Dialog from 'primevue/dialog'
import ToastService from 'primevue/toastservice';
import Textarea from 'primevue/textarea';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia();


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(PrimeVue)
            .use(ToastService)
            .component('Dialog', Dialog)
            .component('Textarea', Textarea)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
