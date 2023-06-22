import {default as PageLogin} from "@/views/pages/auth/login/Main";
import {default as PageRegister} from "@/views/pages/auth/register/Main";
import {default as PageResetPassword} from "@/views/pages/auth/reset-password/Main";
import {default as PageForgotPassword} from "@/views/pages/auth/forgot-password/Main";
import {default as PageNotFound} from "@/views/pages/shared/404/Main";

import {default as PageDashboard} from "@/views/pages/private/dashboard/Main";
import {default as PageProfile} from "@/views/pages/private/profile/Main";
import {default as Agenda} from "@/views/pages/private/agenda/Main";
import {default as Billing} from "@/views/pages/private/billing/Main";
import {default as Tasks} from "@/views/pages/private/tasks/Main";
import {default as Statistics} from "@/views/pages/private/statistics/Main";
import {default as Settings} from "@/views/pages/private/settings/Main";
import {default as Appointments} from "@/views/pages/private/appointments/Main";

import {default as PageUsers} from "@/views/pages/private/users/Index";
import {default as PageUsersCreate} from "@/views/pages/private/users/Create";
import { default as PageUsersEdit } from "@/views/pages/private/users/Edit";

import {default as Profile} from "@/views/pages/private/profile/Main";

import abilities from "@/stub/abilities";

const routes = [
    {
        name: "home",
        path: "/",
        meta: {requiresAuth: false},
        component: PageLogin,
    },
    {
        name: "dashboard",
        path: "/dashboard",
        meta: {requiresAuth: true},
        component: PageDashboard,
    },
    {
        name: "agenda",
        path: "/agenda",
        meta: {requiresAuth: true, requiresAbility: abilities.AGENDA},
        component: Agenda,
    },
    {
        name: "billing",
        path: "/billing",
        meta: {requiresAuth: true, requiresAbility: abilities.BILLING},
        component: Billing,
    },
    {
        name: "task",
        path: "/task",
        meta: {requiresAuth: true, requiresAbility: abilities.TASK},
        component: Tasks,
    },
    {
        name: "statistic",
        path: "/statistic",
        meta: {requiresAuth: true, requiresAbility: abilities.STATISTIC},
        component: Statistics,
    },
    {
        name: "appointment",
        path: "/appointment/:id",
        meta: {requiresAuth: true, requiresAbility: abilities.APPOINTMENT},
        component: Appointments,
        props: true,
    },
    {
        name: "profile",
        path: "/profile",
        meta: {requiresAuth: true, isOwner: true},
        component: PageProfile,
    },
    {
        path: "/users",
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
    // {
    //     path: "/profile",
    //     children: [
    //         {
    //             name: "profile.contact",
    //             path: "contact",
    //             meta: { requiresAuth: true, isOwner: true },
    //             component: PageProfile,
    //         }
    //     ]
    // },
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
