import { defineStore } from 'pinia'
import moment from 'moment'

export const useAgendaStore = defineStore({
    id: "agenda",

    state: () => ({
        currentEvent: {
            id: "",
            title: "",
            start: "",
            end: "",
            startStr: "",
            endStr: "",
            type_id: null,
            entity_id: null,
            mode: "create",
            extendedProps: {
                patient: {},
                type: {},
            },
        },

        currentTime: {
            start: "",
            end: "",
        }
    }),

    actions: {

        setCurrentTime({ start, end}) {
            this.currentTime.start = moment(
                start,
                "ddd MMM DD YYYY HH:mm:ss [GMT]ZZ"
            ).format("YYYY-MM-DDTHH:mm:ssZ")
            
            this.currentTime.end = moment(
                end,
                "ddd MMM DD YYYY HH:mm:ss [GMT]ZZ"
            ).format("YYYY-MM-DDTHH:mm:ssZ")
            
        },

        getCurrentTime() {
            return this.currentTime
        },

        setCurrentEvent(event) {  
            this.currentEvent = event
            this.currentEvent.startStr = moment(event.start).format("YYYY-MM-DDTHH:mm")
            this.currentEvent.endStr = moment(event.end).format("YYYY-MM-DDTHH:mm")
        },

        getCurrentEvent() {
            return this.currentEvent
        },

        setMode(mode) {
            this.mode = mode
        },
    },
});
