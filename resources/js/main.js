import {createApp} from 'vue'
import { createPinia } from 'pinia'
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

import router from "@/router"
import i18n from "@/plugins/i18n" 
import App from "@/App" 
import "@fortawesome/fontawesome-free/css/all.css"
 
const app = createApp(App)
app.directive("tippy", {
    mounted(el, binding) {
        tippy(el, {
            content: binding.value.content,
            placement: binding.value.placement || "center",
            arrow: true,
            theme: "light",
            duration: 200,
            delay: [300, 0],
            maxWidth: 350,
            interactive: true,
            appendTo: document.body,
            allowHTML: true,
        });
    },
});

app.use(createPinia())

app.use(router)
app.use(i18n) 

app.mount('#app')




