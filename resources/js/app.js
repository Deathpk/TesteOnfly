/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import vuetify from './vuetify';
import Vue from 'vue';
import EditPage from './components/EditPage.vue';
import CreatePage from './components/CreatePage.vue';
import Dashboard from './components/Dashboard.vue';
// import Swal from 'sweetalert2';
import VueFilterNumericFormat from '@vuejs-community/vue-filter-numeric-format';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('dashboard-component', require('./components/Dashboard.vue').default);
// Vue.component('edit-form-component', require('./components/EditPage.vue').default);
Vue.component('app-vue', require('./App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
const router = new VueRouter({
    mode:'history',
    routes: [

        {
            path:'/dashboard/home',
            name:'dashboard',
            component: Dashboard
        },
        {
            path: '/dashboard/despesas/create/form',
            name:'createForm',
            component: CreatePage 
        },
        {
            path: '/dashboard/despesas/edit/form',
            name:'editForm',
            component: EditPage 
        }
    ]
});

Vue.use(VueFilterNumericFormat, {
    decimalSeparator: ',',
    fractionDigitsMax: 2,
    fractionDigitsMin: 2,
    fractionDigitsSeparator: '',
    thousandsDigitsSeparator: '.'
});

const app = new Vue({
    el: '#app',
    vuetify,
    router,
});
