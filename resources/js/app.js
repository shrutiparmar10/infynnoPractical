/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
import { Form } from 'vform';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Swal from "sweetalert2";

window.Vue = require('vue').default;
Vue.use(VueRouter)


window.Form = Form;
window.Swal = Swal;
window.axios = require('axios');



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
let routes = [{
        path: "/dashboard",
        name: "dashboard",
        component: require('./components/ExampleComponent.vue').default
    }, {
        path: "/developer",
        name: "developer",
        component: require('./components/Developer.vue').default
    },
    {
        path: "/add-developer",
        name: "add-developer",
        component: require('./components/DeveloperCrud.vue').default
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
});