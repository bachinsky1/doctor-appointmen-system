

import './bootstrap'
import { createApp } from 'vue'
import { createPinia } from "pinia"
import axios from 'axios'
import router from './router'

const pinia = createPinia()

import Symbols from './components/Symbols.vue'
import NextAppointments from './components/dashboard/NextAppointments.vue'
import Activities from './components/dashboard/Activities.vue'
import DocumentsToClassify from './components/dashboard/DocumentsToClassify.vue'
import Tasks from './components/dashboard/Tasks.vue'
import ContactInformation from './components/profile/ContactInformation.vue'
import AddressInformation from './components/profile/AddressInformation.vue'
import WorkingPlaceInformation from './components/profile/WorkingPlaceInformation.vue'

const app = createApp({})

app.config.globalProperties.$axios = axios
app.use(router)
app.use(pinia)

app.component('next-appointments-component', NextAppointments)
app.component('activities-component', Activities)
app.component('documents-to-classify-component', DocumentsToClassify)
app.component('tasks-component', Tasks)
app.component('symbols-component', Symbols)
app.component('contact-information', ContactInformation)
app.component('address-information', AddressInformation)
app.component('working-place-information', WorkingPlaceInformation)

app.mount("#app")