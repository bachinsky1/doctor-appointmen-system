/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from "pinia";
import axios from 'axios';
import router from './router';
const pinia = createPinia();


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
 
import Sidebar from './components/Sidebar.vue'; 
import NextAppointments from './components/dashboard/NextAppointments.vue'; 
import Activities from './components/dashboard/Activities.vue'; 
import DocumentsToClassify from './components/dashboard/DocumentsToClassify.vue'; 
import Tasks from './components/dashboard/Tasks.vue'; 

const app = createApp({}); app.config.globalProperties.$axios = axios;

app.use(pinia);

app.component('sidebar-component', Sidebar);
app.component('next-appointments-component', NextAppointments);
app.component('activities-component', Activities);
app.component('documents-to-classify-component', DocumentsToClassify);
app.component('tasks-component', Tasks);

app.mount("#app");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

// app.mount('#app');

(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl)
    })
})()
