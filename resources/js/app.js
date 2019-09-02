/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import moment from 'moment'
import Swal from 'sweetalert2'
import VueProgressBar from 'vue-progressbar'
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
window.Fire = new Vue();
window.Swal = Swal;

Vue.use(VueRouter)
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px'
})


let routes = [
    { path: '/admin/home', component: require('./components/ExampleComponent.vue').default },
    { path: '/admin/profile', component: require('./components/ProfileComponent.vue').default },
    { path: '/admin/bidang-studi', component: require('./components/Penilaian/BidangStudiComponent.vue').default },
    { path: '/admin/kompetensi-keahlian', component: require('./components/Penilaian/KompetensiKeahlianComponent.vue').default },
    { path: '/admin/siswa', component: require('./components/Penilaian/SiswaComponent.vue').default },
  ]

const router = new VueRouter({
    mode: 'history', // Untuk menghapus semua awalan url [Ex: ujikom.test/home#/dashboard => ujikom.test/dashboard]
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
