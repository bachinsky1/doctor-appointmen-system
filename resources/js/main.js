import {createApp} from 'vue'
import { createPinia } from 'pinia'

import router from "@/router"
import i18n from "@/plugins/i18n"
import App from "@/App"
import { ProCalendar } from "@lbgm/pro-calendar-vue"


const app = createApp(App)

app.use(createPinia());

app.use(router)
app.use(i18n)
app.use(ProCalendar)
app.mount('#app')




