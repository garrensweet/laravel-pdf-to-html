import Vue from 'vue'
import App from '@/App.vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
;(window as any)._ = require('lodash')
;(window as any).axios = require('axios')
;(window as any).axios.defaults.headers.common['X-Requested-With'] =
    'XMLHttpRequest'

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    ;(window as any).axios.defaults.headers.common[
        'X-CSRF-TOKEN'
    ] = (token as HTMLMetaElement).content
} else {
    console.error(
        'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
    )
}

import Echo from 'laravel-echo'
;(window as any).Pusher = require('pusher-js')
;(window as any).Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
})

new Vue({
    el: '#app',
    render: (h: any) => h(App),
})
