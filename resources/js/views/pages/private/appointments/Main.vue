<template>
    <Page>
        <div class="w-full bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/6">
                <a href="#" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="getAppointments"> Create appointment </a>
            </div>
            <div class="w-5/6">
                <div class='demo-app-main'>
                    <FullCalendar v-if="showCalendar" class='demo-app-calendar' :options='calendarOptions'>
                        <template v-slot:eventContent='arg'>
                            <b>{{ arg.timeText }}</b>
                            <i>{{ arg.event.title }}</i>
                        </template>
                    </FullCalendar>
                </div>
            </div>
        </div>
    </Page>
</template>

<script>

import { defineComponent, ref } from "vue"
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import moment from 'moment'
import Page from "@/views/layouts/Page"
import CalendarService from '@/services/CalendarService'
import Alert from "@/views/components/Alert"
import { useAlertStore } from "@/stores"

export default defineComponent({
    components: {
        FullCalendar,
        Page,
        Alert,
    },

    props: {
        id: {
            type: String,
            required: true
        },
    },

    data() {
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                validRange: function (nowDate) {
                    // Determining the last day of the week
                    const momentDate = moment(nowDate)
                    const lastDayOfWeek = momentDate.endOf('week').subtract(1, 'day')
                    // Returning a date range without the last days of the week
                    return {
                        start: momentDate,
                        end: lastDayOfWeek
                    };
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [],
                firstDay: 1,
                scrollTime: 0,
                locale: 'en-GB',
                dateClick: this.handleDateClick,
                initialView: 'dayGridMonth',

                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents,
                /* you can update a remote database when these fire:*/
                eventAdd: this.eventAdd,
                eventChange: this.eventChange,
                eventRemove: this.eventRemove,

            },
            showCalendar: false,
            calendarPlugins: [dayGridPlugin, timeGridPlugin],
            calendarView: 'dayGridMonth'
        }
    },

    methods: {

        handleDateSelect(info) {
            if (info.start < new Date()) {
                const alertStore = useAlertStore()
                alertStore.error('Cannot select past time')
                console.log('Cannot select past time')
                return false
            }
        },


        async getAppointments() {

            this.showCalendar = true
            const service = new CalendarService()
            const response = await service.getAgenda(this.id)
            this.calendarOptions.events = response.data.appointments
            this.appointmentTypes = response.data.appointmentTypes
        },
    },

    watch: {
        id: function () {
            this.calendarOptions.events = []
            this.showCalendar = false
        }
    }

})
</script>