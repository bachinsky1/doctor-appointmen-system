import { createWebHistory, createRouter } from "vue-router";
import Agenda from './../views/Agenda.vue'
import Billing from './../views/Billing.vue'
import Tasks from './../views/Tasks.vue'
import Statistics from './../views/Statistics.vue'
import { useTestStore } from "../store/store"

const routes = [
    {
        path: "/agenda",
        name: "agenda",
        component: Agenda,
        beforeEnter: (to, from, next) => {
            if (useTestStore().data) {
                console.log(`Data from store: ${useTestStore().data}`)
                next()
            }
            else next()
        },
    },
    {
        path: "/billing",
        name: "billing",
        component: Billing,
        beforeEnter: (to, from, next) => {
            next()
        },
    },
    {
        path: "/tasks",
        name: "tasks",
        component: Tasks,
        beforeEnter: (to, from, next) => {
            next()
        },
    },
    {
        path: "/statistics",
        name: "statistics",
        component: Statistics,
        beforeEnter: (to, from, next) => {
            next()
        },
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router