

<template>
    <div class='demo-app'>
        <div class='demo-app-sidebar'>
            <div class='demo-app-sidebar-section'>
                <h2>Instructions</h2>
                <ul>
                    <li>Select dates and you will be prompted to create a new event</li>
                    <li>Drag, drop, and resize events</li>
                    <li>Click an event to delete it</li>
                </ul>
            </div>
            <div class='demo-app-sidebar-section'>
                <label>
                    <input type='checkbox' :checked='calendarOptions.weekends' @change='handleWeekendsToggle' /> toggle weekends </label>
            </div>
            <div class='demo-app-sidebar-section'>
                <h2>All Events ({{ currentEvents.length }})</h2>
                <ul>
                    <li v-for='event in currentEvents' :key='event.id'>
                        <b>{{ event.startStr }}</b>
                        <i>{{ event.title }}</i>
                    </li>
                </ul>
            </div>
        </div>
        <div class='demo-app-main'>
            <FullCalendar class='demo-app-calendar' :options='calendarOptions'>
                <template v-slot:eventContent='arg'>
                    <b>{{ arg.timeText }}</b>
                    <i>{{ arg.event.title }}</i>
                </template>
            </FullCalendar>
        </div>
    </div>
    <Modal :is-showing="isShowing" @close="isShowing = false;">
        <Appointment @error="isShowing = false;" @done="handleCalendarEvent" :onEventChange="eventChange" :onEventRemove="eventRemove" />
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
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                validRange: function (nowDate) {
                    // Determining the last day of the week
                    var momentDate = moment(nowDate)
                    var lastDayOfWeek = momentDate.endOf('week').subtract(1, 'day')
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
                // initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
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
            selectInfo: null,
            currentEvents: [],
            isShowing: false,
        }
    },

    mounted() {
        const service = new CalendarService()
        service.getAppointments().then((response) => {
            this.calendarOptions.events = response.data
        })
    },

    methods: {

        async eventAdd(event) {
            console.log('eventAdd', event)
            const service = new CalendarService()
            await service.storeAppointment(event)
        },

        eventChange(event) {
            const index = this.calendarOptions.events.findIndex(e => e.id === Number(event.id))

            // console.log('eventChange', index, event.id)
            if (index !== -1) {
                // console.log('eventChange', event.id, this.calendarOptions.events[index])
                this.calendarOptions.events[index] = event

                console.log(event.start, event.end)
            }
        },

        async eventRemove(event) {
            console.log('eventRemove', event.extendedProps)
            this.isShowing = false
            const service = new CalendarService()
            await service.destroyAppointment(event.extendedProps.public_id)

            this.calendarOptions.events = this.calendarOptions.events.filter(e => {
                console.log(e, event.extendedProps.public_id,)
                return e.public_id !== event.extendedProps.public_id
            })
        },

        handleCalendarEvent(event) {
            console.log(111, event)
            const calendarApi = this.selectInfo.view.calendar

            const newAppointment = {
                id: createEventId(),
                public_id: createEventId(),
                title: event.title,
                start: new Date(event.start),
                end: new Date(event.end),
            }
            this.calendarOptions.events.push(newAppointment)
            calendarApi.addEvent(newAppointment)
            console.log('newAppointment', this.calendarOptions.events)
            this.isShowing = false
        },

        handleWeekendsToggle() {
            // console.log(this.calendarOptions)
            this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
        },

        handleDateSelect(selectInfo) {
            this.isShowing = true
            this.selectInfo = selectInfo

            const store = useCalendarStore()

            store.setPopupInputs({
                start: selectInfo.startStr,
                end: selectInfo.endStr,
            })
        },

        handleEventClick(clickInfo) {
            this.isShowing = true
            const id = clickInfo.event.id
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
            // console.log(clickInfo.view.getCurrentData())
            store.setCurrentEvent(clickInfo.event)
            console.log(clickInfo.event)
        },

        handleEvents(events) {
            console.log(events)
            this.currentEvents = events
        },
    }
})

</script>

<style lang='css'>
h2 {
    margin: 0;
    font-size: 16px;
}

ul {
    margin: 0;
    padding: 0 0 0 1.5em;
}

li {
    margin: 1.5em 0;
    padding: 0;
}

b {
    /* used for event dates/times */
    margin-right: 3px;
}

.demo-app {
    display: flex;
    min-height: 100%;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
}

.demo-app-sidebar {
    width: 300px;
    line-height: 1.5;
    background: #eaf9ff;
    border-right: 1px solid #d3e2e8;
}

.demo-app-sidebar-section {
    padding: 2em;
}

.demo-app-main {
    flex-grow: 1;
    padding: 3em;
}

.fc {
    /* the calendar root */
    max-width: 1100px;
    margin: 0 auto;
}
</style>
