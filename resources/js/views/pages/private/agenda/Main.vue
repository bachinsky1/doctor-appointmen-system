<script setup lang="ts">
import "@lbgm/pro-calendar-vue/style"
import { ref, type Ref } from "vue"
import type { Configs, Appointment } from "@lbgm/pro-calendar-vue"

const cfg = ref<Configs>({
    viewEvent: undefined,
    reportEvent: {
        icon: true,
        text: "",
    },
    searchPlaceholder: "",
    eventName: "",
    closeText: "",
    nativeDatepicker: true,
})

const evts: Ref<Appointment[]> = ref([
    {
        date: "2022-11-19T14:00:00.000Z",
        comment: "",
        id: "cl32rbkjk1700101o53e3e3uhn",
        keywords: "Projet BAMBA",
        name: "MONTCHO Kévin",
    },
    //...
]);

</script>

<template>
    <!-- all props are optional -->
    <pro-calendar :events="evts" :loading="false" :config="cfg" view="month" date="2022-11-10T00:00:00.000Z" @calendarClosed="void 0" @fetchEvents="void 0" />
</template>