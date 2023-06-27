

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
        <Appointment @error="isShowing = false;" @done="handleCalendarEvent" :onEventChange="eventChange" :onEventRemove="eventRemove" :onEventApprove="eventApprove" :mode="mode" />
    </Modal>
</template>

<script>
import { defineComponent, ref } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { createEventId } from '@/helpers/utils'
import moment from 'moment'
import Modal from '@/views/components/Modal.vue'
import Appointment from '@/views/components/Appointment.vue'
import { useAgendaStore } from '@/stores'
import AgendaService from '@/services/AgendaService' 


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
                initialView: 'timeGridWeek', 
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
                datesSet: this.handleDatesSet,
                viewDidMount: this.handleViewDidMount,

            },
            selectInfo: null,
            currentEvents: [],
            isShowing: false,
            mode: '', 
        }
    },

    mounted() {
    //    this.loadAppointments()
        
        // this.handleDatesSet()
    },

    methods: {
        async loadAppointments() {
            const service = new AgendaService()
            const response = await service.getAgenda()

            const appointments = response.data

            for (let index = 0; index < appointments.length; index++) {

                if (!!appointments[index].approved) {
                    appointments[index].backgroundColor = 'green'
                }
            }
            this.calendarOptions.events = appointments
        },

        async eventAdd(event) {
            const service = new AgendaService()
            await service.storeAppointment(event)
        },

        eventChange(event) {
            const index = this.calendarOptions.events.findIndex(e => e.id == event.id)

            if (index !== -1) {
                this.calendarOptions.events[index] = event
            }
        },

        async eventApprove(event) {
            this.isShowing = false
            const service = new AgendaService()
            const result = await service.approveAppointment(event.extendedProps.public_id)
        },

        async eventRemove(event) {
            this.isShowing = false
            const service = new AgendaService()
            await service.destroyAppointment(event.extendedProps.public_id)

            this.calendarOptions.events = this.calendarOptions.events.filter(e => e.public_id !== event.extendedProps.public_id)
        },

        handleCalendarEvent(event) {
            console.log(event)
            const newAppointment = {
                id: createEventId(),
                public_id: createEventId(),
                title: event.title,
                start: new Date(event.start),
                end: new Date(event.end),
                type_id: event.extendedProps.type.id,
                entity_id: event.extendedProps.patient.id,
                extendedProps: event.extendedProps
            }

            const calendarApi = this.selectInfo.view.calendar
            calendarApi.addEvent(newAppointment)
            this.isShowing = false
        },

        handleWeekendsToggle() {
            // console.log(this.calendarOptions)
            this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
        },

        handleDateSelect(clickInfo) {
            console.log('handleDateSelect')
            this.selectInfo = clickInfo
            this.isShowing = true
            this.mode = 'new'

            clickInfo.title = ''
            clickInfo.extendedProps = {}
            clickInfo.extendedProps.patient = {}
            clickInfo.extendedProps.type = {}
            clickInfo.extendedProps.type_id = null
            clickInfo.extendedProps.patient_id = null

            const store = useAgendaStore()
            store.setCurrentEvent(clickInfo)
        },

        handleEventClick(clickInfo) {
            this.isShowing = true
            this.mode = 'update'

            const store = useAgendaStore()
            store.setCurrentEvent(clickInfo.event.toPlainObject())
        },

        handleEvents(events) {
            this.currentEvents = events
            // console.log(this.currentEvents)
        },

        async handleDatesSet(info) {
            // console.log('handleDatesSet', info)
            const start = info.startStr
            const end = info.endStr

            const service = new AgendaService()
            const response = await service.getAgenda({start, end})

            const appointments = response.data

            for (let index = 0; index < appointments.length; index++) {

                if (!!appointments[index].approved) {
                    appointments[index].backgroundColor = 'green'
                }
            }
            this.calendarOptions.events = appointments
        },

        async handleViewDidMount(info) {
            // console.log('handleViewDidMount', info)
            const start = moment(info.view.activeStart, 'ddd MMM DD YYYY HH:mm:ss [GMT]ZZ').format('YYYY-MM-DDTHH:mm:ssZ')
            const end = moment(info.view.activeEnd, 'ddd MMM DD YYYY HH:mm:ss [GMT]ZZ').format('YYYY-MM-DDTHH:mm:ssZ')
            
            const service = new AgendaService()
            const response = await service.getAgenda({start, end})

            const appointments = response.data

            for (let index = 0; index < appointments.length; index++) {

                if (!!appointments[index].approved) {
                    appointments[index].backgroundColor = 'orange'
                }
            }
            this.calendarOptions.events = appointments
        },
    }
})
</script>