import { defineStore } from 'pinia'
import moment from 'moment'

export const useCalendarStore = defineStore({
    id: 'calendar',
    state: () => ({
        id: '',
        title: '',
        start: '',
        end: '',
        mode: 'create',
        currentEvent: {}
    }),
    actions: {
        setPopupInputs({ id, title, start, end }) {
            this.id = id
            this.title = title
            this.start = moment(start).format("YYYY-MM-DDTHH:mm")
            this.end = moment(end).format("YYYY-MM-DDTHH:mm")
        },

        setCurrentEvent(event) { 
            this.currentEvent = event
        },

        getCurrentEvent() { return this.currentEvent },
        
        setMode(mode) {
            this.mode = mode
        }
    }
});
