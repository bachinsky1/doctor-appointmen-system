

import './bootstrap'
import { createApp } from 'vue'
import { createPinia } from "pinia"
import axios from 'axios'
import router from './router'

const pinia = createPinia()

// import Agenda from './components/Agenda.vue' 
import NextAppointments from './components/dashboard/NextAppointments.vue'
import Activities from './components/dashboard/Activities.vue'
import DocumentsToClassify from './components/dashboard/DocumentsToClassify.vue'
import Tasks from './components/dashboard/Tasks.vue'

const app = createApp({})
app.config.globalProperties.$axios = axios
app.use(router)
app.use(pinia)

app.component('next-appointments-component', NextAppointments)
app.component('activities-component', Activities)
app.component('documents-to-classify-component', DocumentsToClassify)
app.component('tasks-component', Tasks)
// app.component('tasks-component', Agenda);

app.mount("#app")