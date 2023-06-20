
<template>
    <div class="demo-app">
        <div class="demo-app-sidebar">
            <div class="demo-app-sidebar-section">
                <h2>Instructions</h2>
                <ul>
                    <li>Select dates and you will be prompted to create a new event</li>
                    <li>Drag, drop, and resize events</li>
                    <li>Click an event to delete it</li>
                </ul>
            </div>
            <div class="demo-app-sidebar-section">
                <label>
                    <input type="checkbox" :checked="calendarOptions.weekends" @change="handleWeekendsToggle" /> toggle weekends </label>
            </div>
            <div class="demo-app-sidebar-section">
                <h2>All Events ({{ currentEvents.length }})</h2>
                <ul>
                    <li v-for="event in currentEvents" :key="event.id">
                        <b>{{ event.startStr }}</b>
                        <i>{{ event.title }}</i>
                    </li>
                </ul>
            </div>
        </div>
        <div class='demo-app-main'>
            <FullCalendar class='demo-app-calendar' ref="fullcalendar" :options='calendarOptions'>
                <template v-slot:eventContent='arg'>
                    <b>{{ arg.timeText }}</b>
                    <i>{{ arg.event.title }}</i>
                </template>
            </FullCalendar>
        </div>
    </div>
    <Modal :is-showing="isShowing" @close="isShowing = false">
        <Appointment @error="isShowing = false" @done="handleCalendarEvent" :onEventChange="eventChange" :onEventRemove="eventRemove" />
    </Modal>
</template>

<script>
import { defineComponent, ref } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { createEventId } from './../agenda/utils'
import moment from 'moment'
import Modal from '@/views/components/Modal.vue'
import Appointment from '@/views/components/Appointment.vue'
import { useCalendarStore } from '@/stores'
import CalendarService from '@/services/CalendarService'

export default defineComponent({
    components: {
        FullCalendar,
        Modal,
        Appointment,
    },

    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                validRange(nowDate) {
                    const momentDate = moment(nowDate)
                    const lastDayOfWeek = momentDate.endOf('week').subtract(1, 'day')
                    return {
                        start: momentDate,
                        end: lastDayOfWeek,
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
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
            },
            currentEvents: [],
            isShowing: false,
        }
    },

    mounted() {
        const service = new CalendarService()
        service.getAppointments().then((response) => {
            console.log(response.data)
            this.calendarOptions.events = response.data
            this.currentEvents = response.data
        })

    },

    methods: {
        async eventAdd(event) {
            const service = new CalendarService()
            await service.storeAppointment(event)
            // this.calendarOptions.events.push({
            //     title: event.title,
            //     start: event.start,
            //     end: event.end,
            //     extendedProps: event.extendedProps,
            // })
            // this.$refs.fullcalendar.refetchEvents()
            console.log('eventAdd', event, this.calendarOptions.events)
        },

        eventChange(event) {
            // const index = this.calendarOptions.events.findIndex(e => e.id === Number(event.id))

            // // console.log('eventChange', index, event.id)
            // if (index !== -1) {
            //     // console.log('eventChange', event.id, this.calendarOptions.events[index])
            //     this.calendarOptions.events[index] = event

            //     console.log(event.start, event.end)
            // }
        },

        async eventRemove(event) {
            // console.log('eventRemove', event.extendedProps)
            this.isShowing = false
            const service = new CalendarService()
            await service.destroyAppointment(event.extendedProps.internal_id)
            console.log(event.extendedProps, this.calendarOptions.events)
            // this.calendarOptions.events = this.calendarOptions.events.filter(e => {
            //     console.log(e, event)
            //     return false
            //     // return e.internal_id !== event.event.extendedProps.internal_id
            // })

        },

        handleCalendarEvent(event) {
            const calendarApi = this.selectInfo.view.calendar

            const newAppointment = {
                extendedProps: {
                    internal_id: createEventId(),
                },
                title: event.title,
                start: new Date(event.start),
                end: new Date(event.end),
            }
            calendarApi.addEvent(newAppointment)

            this.isShowing = false
        },

        handleWeekendsToggle() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends
        },

        handleDateSelect(selectInfo) {
            this.isShowing = true

            const store = useCalendarStore()

            store.setPopupInputs({
                start: selectInfo.startStr,
                end: selectInfo.endStr,
            })
        },

        handleEventClick(clickInfo) {
            this.isShowing = true
            const id = clickInfo.event.extendedProps.internal_id
            const title = clickInfo.event.title
            const start = clickInfo.event.start
            const end = clickInfo.event.end

            const store = useCalendarStore()
            store.setPopupInputs({
                id,
                title,
                start,
                end,
            })
            store.setCurrentEvent(clickInfo.event)
            // console.log('handleEventClick', clickInfo.event)
        },

        handleEvents(events) {
            // console.log(events)
            this.currentEvents = events
        },
    },
});

</script>

