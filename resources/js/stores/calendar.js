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
    }),
    actions: {
        setPopupInputs({ id, title, start, end }) {
            this.id = id
            this.title = title
            this.start = moment(start).format("YYYY-MM-DDTHH:mm")
            this.end = moment(end).format("YYYY-MM-DDTHH:mm")
        },
        
        setMode(mode) {
            this.mode = mode
        }
    }
});
