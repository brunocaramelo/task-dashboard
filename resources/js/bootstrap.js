/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY || 'jam48bucncw3cqxdtkpj',
    wsHost: import.meta.env.VITE_REVERB_HOST || 'localhost',
    wsPort: import.meta.env.VITE_REVERB_PORT || 8182,
    wssPort: import.meta.env.VITE_REVERB_PORT || 8182,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
    disableStats: true,
});


window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('WebSocket connected!');
});

