import {default as PageLogin} from "@/views/pages/auth/login/Main.vue";
import {default as PageRegister} from "@/views/pages/auth/register/Main.vue";
import {default as PageResetPassword} from "@/views/pages/auth/reset-password/Main.vue";
import {default as PageForgotPassword} from "@/views/pages/auth/forgot-password/Main.vue";
import {default as PageNotFound} from "@/views/pages/shared/404/Main.vue";

import {default as PageDashboard} from "@/views/pages/private/dashboard/Main.vue";
import {default as PageProfile} from "@/views/pages/private/profile/Main.vue";
import {default as Agenda} from "@/views/pages/private/agenda/Main.vue";
import {default as Billing} from "@/views/pages/private/billing/Main.vue";
import {default as Tasks} from "@/views/pages/private/tasks/Main.vue";
import {default as Statistics} from "@/views/pages/private/statistics/Main.vue";
import {default as Settings} from "@/views/pages/private/settings/Main.vue";

import {default as PageUsers} from "@/views/pages/private/users/Index.vue";
import {default as PageUsersCreate} from "@/views/pages/private/users/Create.vue";
import { default as PageUsersEdit } from "@/views/pages/private/users/Edit.vue";

import {default as Profile} from "@/views/pages/private/profile/Main.vue";

import abilities from "@/stub/abilities";

const routes = [
    {
        name: "home",
        path: "/",
        meta: {requiresAuth: false},
        component: PageLogin,
    },
    {
        name: "panel",
        path: "/panel",
        children: [
            {
                name: "dashboard",
                path: "dashboard",
                meta: {requiresAuth: true},
                component: PageDashboard,
            },
            {
                name: "agenda",
                path: "agenda",
                meta: {requiresAuth: true},
                component: Agenda,
            },
            {
                name: "billing",
                path: "billing",
                meta: {requiresAuth: true},
                component: Billing,
            },
            {
                name: "tasks",
                path: "tasks",
                meta: {requiresAuth: true},
                component: Tasks,
            },
            {
                name: "statistics",
                path: "statistics",
                meta: {requiresAuth: true},
                component: Statistics,
            },
            {
                name: "profile",
                path: "profile",
                meta: {requiresAuth: true, isOwner: true},
                component: PageProfile,
            },
            {
                path: "users",
                children: [
                    {
                        name: "users.list",
                        path: "list",
                        meta: {requiresAuth: true, requiresAbility: abilities.LIST_USER},
                        component: PageUsers,
                    },
                    {
                        name: "users.create",
                        path: "create",
                        meta: {requiresAuth: true, requiresAbility: abilities.CREATE_USER},
                        component: PageUsersCreate,
                    },
                    {
                        name: "users.edit",
                        path: ":id/edit",
                        meta: {requiresAuth: true, requiresAbility: abilities.EDIT_USER},
                        component: PageUsersEdit,
                    },
                ]
            },
            {
                path: "profile",
                children: [
                    {
                        name: "profile.contact",
                        path: "contact",
                        meta: { requiresAuth: true, isOwner: true },
                        component: Profile,
                    }
                ]
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        meta: {requiresAuth: false},
        component: PageLogin,
    },
    {
        path: "/register",
        name: "register",
        meta: {requiresAuth: false},
        component: PageRegister,
    },
    {
        path: "/reset-password",
        name: "resetPassword",
        meta: {requiresAuth: false},
        component: PageResetPassword,
    },
    {
        path: "/forgot-password",
        name: "forgotPassword",
        meta: {requiresAuth: false},
        component: PageForgotPassword,
    },
    {
        path: "/:catchAll(.*)",
        name: "notFound",
        meta: {requiresAuth: false},
        component: PageNotFound,
    },
]

export default routes;
