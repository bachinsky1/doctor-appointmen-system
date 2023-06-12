import { createWebHistory, createRouter } from "vue-router";
import Agenda from '../views/Agenda.vue'
import Billing from '../views/Billing.vue'
import Tasks from '../views/Tasks.vue'
import Statistics from '../views/Statistics.vue'
import Profile from '../views/Profile.vue'
import Settings from '../views/Settings.vue'
import { useStore } from "../store/store"

const routes = [
    {
        path: "/agenda",
        name: "agenda",
        component: Agenda,
        beforeEnter: (to: any, from: any, next: () => void) => {
            if (useStore().data) {
                console.log(`Data from store: ${useStore().data}`)
                next()
            }
            else next()
        },
    },
    {
        path: "/billing",
        name: "billing",
        component: Billing,
        beforeEnter: (to: any, from: any, next: () => void) => {
            next()
        },
    },
    {
        path: "/tasks",
        name: "tasks",
        component: Tasks,
        beforeEnter: (to: any, from: any, next: () => void) => {
            next()
        },
    },
    {
        path: "/statistics",
        name: "statistics",
        component: Statistics,
        beforeEnter: (to: any, from: any, next: () => void) => {
            next()
        },
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
        beforeEnter: (to: any, from: any, next: () => void) => {
            if (useStore().data) {
                console.log(`Data from store: ${useStore().data}`)
                next()
            }
            else next()
        },
    },
    {
        path: "/settings",
        name: "settings",
        component: Settings,
        beforeEnter: (to: any, from: any, next: () => void) => {
            
        },
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router