import { createWebHistory, createRouter } from "vue-router";
import Agenda from './../components/Agenda.vue'
import Billing from './../components/Billing.vue'
import Tasks from './../components/Tasks.vue'
import Statistics from './../components/Statistics.vue'

const routes = [
    {
        path: "/",
        name: "Wlcome",
        // component: Home,
    },
    {
        path: "/agenda",
        name: "agenda",
        component: Agenda,
    },
    {
        path: "/billing",
        name: "billing",
        component: Billing,
    },
    {
        path: "/tasks",
        name: "tasks",
        component: Tasks,
    },
    {
        path: "/statistics",
        name: "statistics",
        component: Statistics,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;