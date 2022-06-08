window._ = require('lodash');

try {
    window.select2 = require('select2');
    window.toastr = require('toastr');
    window.$ = window.jQuery = require('jquery');
    window.bootstrap = require('bootstrap');

    /**
    * Bootstrap Table
    */
    require('bootstrap-table');
    require('bootstrap-table/dist/locale/bootstrap-table-pt-BR');
    require('bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js');
    require('bootstrap-table/dist/extensions/cookie/bootstrap-table-cookie.min.js');
    require('tableexport.jquery.plugin');

} catch (e) { }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    //'Authorization': 'Bearer ' + window.Laravel.apiToken,
};

window.base_url_api = document.querySelector('meta[ref="js-base_url_api"]').content
window.base_url = document.querySelector('meta[ref="js-base_url"]').content
window.i_url = document.querySelector('meta[ref="url"]').content

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
