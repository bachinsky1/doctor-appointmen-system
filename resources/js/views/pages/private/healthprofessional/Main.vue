<template>
    <Page>
        <div class="w-full bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/6">
                <a href="#" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="getAppointments"> Appointments </a>
            </div>
            <div class="w-5/6">
                <div class='demo-app-main'>
                    <FullCalendar v-if="showCalendar" class='demo-app-calendar' :options='calendarOptions' ref="fullCalendar">
                        <template v-slot:eventContent='arg'>
                            <b>{{ arg.timeText }}</b>
                            <i>{{ arg.event.title }}</i>
                        </template>
                    </FullCalendar>
                </div>
            </div>
        </div>
        <Modal :is-showing="isShowing" @close="isShowing = false;">
            <Appointment @error="isShowing = false;" @done="handleCalendarEvent" :onEventChange="eventChange" :onEventRemove="eventRemove" :mode="mode" />
        </Modal>
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
import Modal from '@/views/components/Modal.vue'
import AgendaService from '@/services/AgendaService'
import Appointment from '@/views/components/AppointmentPatient.vue'
import Alert from "@/views/components/Alert"
import { useAlertStore, useAgendaStore } from "@/stores"
import { createEventId } from '@/helpers/utils'

export default defineComponent({
    components: {
        FullCalendar,
        Page,
        Alert,
        Modal,
        Appointment,
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
                selectConstraint: {
                    start: moment().startOf('day').format(),
                },
                events: [],
                firstDay: 1,
                scrollTime: 0,
                locale: 'en-GB',
                dateClick: this.handleDateClick,
                initialView: 'timeGridWeek',
                selectOverlap: false,
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
                eventDrop: this.eventDropOrResize,
                eventResize: this.eventDropOrResize,
                eventRemove: this.eventRemove,
                datesSet: this.handleDatesSet,
                viewDidMount: this.handleViewDidMount,
            },
            showCalendar: false,
            calendarPlugins: [dayGridPlugin, timeGridPlugin],
            calendarView: 'dayGridMonth',
            isShowing: false,
            mode: '',
            selectInfo: null,
            currentEvents: [],
        }
    },

    methods: {
        async eventDropOrResize(info) {

            const event = this.checkEvent(info)
            if (!!event === false) return

            await this.agendaService.changeAppointment(event)
        },

        checkEvent(info) {
            const event = info.event

            if (event.extendedProps.patient.id !== this.currentUser.id) {
                info.revert()
                return false
            }

            if (!confirm("Are you sure about this change?")) {
                info.revert()
                return false
            }

            return event
        },

        async eventAdd(event) {
            await this.agendaService.storeAppointment(event)
        },

        eventChange(event) {
            const index = this.calendarOptions.events.findIndex(e => e.id == event.id)

            if (index !== -1) {
                this.calendarOptions.events[index] = event
            }
        },

        async eventRemove(event) {
            // console.log('eventRemove', event.extendedProps)
            this.isShowing = false
            await this.agendaService.destroyAppointment(event.extendedProps.public_id)

            this.calendarOptions.events = this.calendarOptions.events.filter(e => e.public_id !== event.extendedProps.public_id)
        },

        handleEventClick(clickInfo) {
            const event = clickInfo.event
            // console.log(event)
            if (event.extendedProps.patient.id === this.currentUser.id) {
                this.isShowing = true
                this.mode = 'update'

                this.agendaStore.setCurrentEvent(clickInfo.event.toPlainObject())
            }
        },

        handleDateSelect(clickInfo) {

            if (clickInfo.start < new Date()) {
                this.alertStore.error('Cannot select past time')
                return false
            }

            this.selectInfo = clickInfo
            this.isShowing = true
            this.clickInfo = clickInfo
            this.mode = 'new'

            clickInfo.title = ''
            clickInfo.extendedProps = {}
            clickInfo.extendedProps.patient = {}
            clickInfo.extendedProps.type = {}
            clickInfo.extendedProps.type_id = null
            clickInfo.extendedProps.patient_id = null

            this.agendaStore.setCurrentEvent(clickInfo)
        },

        handleCalendarEvent(event) {

            const calendarApi = this.selectInfo.view.calendar

            const newAppointment = {
                id: createEventId(),
                public_id: createEventId(),
                title: event.title,
                start: new Date(event.start),
                end: new Date(event.end),
                type_id: event.extendedProps.type.id,
                entity_id: this.id,
                backgroundColor: 'green',
                extendedProps: event.extendedProps
            }
            this.calendarOptions.events.push(newAppointment)
            calendarApi.addEvent(newAppointment)

            this.isShowing = false
        },

        async getAppointments() {
            this.showCalendar = true
        },

        async handleDatesSet(info) {
            const start = info.startStr
            const end = info.endStr

            const response = await this.agendaService.getAgenda({
                id: this.id,
                start,
                end
            })
 
            const appointments = this.checkAppointments(response.data)
        
            this.calendarOptions.events = appointments

            const now = new Date()
            this.$refs.fullCalendar.getApi().scrollToTime(now.toTimeString(), { block: 'center' })
        },


        checkAppointments(appointments) {
            for (let index = 0; index < appointments.length; index++) {
                if (appointments[index].patient_id === this.currentUser.id) {
                    if (!!appointments[index].approved) {
                        appointments[index].backgroundColor = 'orange'
                    } else {
                        appointments[index].backgroundColor = 'green'
                    }
                }
            }

            return appointments
        },

        async handleViewDidMount(info) {
            // console.log('handleViewDidMount', info)
            const start = moment(info.view.activeStart, 'ddd MMM DD YYYY HH:mm:ss [GMT]ZZ').format('YYYY-MM-DDTHH:mm:ssZ')
            const end = moment(info.view.activeEnd, 'ddd MMM DD YYYY HH:mm:ss [GMT]ZZ').format('YYYY-MM-DDTHH:mm:ssZ')

            const response = await this.agendaService.getAgenda({
                id: this.id,
                start,
                end
            })
 
            const appointments = this.checkAppointments(response.data)
            
            this.calendarOptions.events = appointments
        },

    },

    setup() {
        const currentUser = JSON.parse(localStorage.getItem("currentUser"))
        const agendaStore = useAgendaStore()
        const agendaService = new AgendaService()
        const alertStore = useAlertStore()

        return {
            currentUser,
            agendaStore,
            agendaService,
            alertStore
        };
    },

    watch: {
        id: function () {
            this.calendarOptions.events = []
            this.showCalendar = false
        }
    }

})
</script>