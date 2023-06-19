import { defineStore } from 'pinia'
import moment from 'moment'

export const useCalendarStore = defineStore({
    id: 'calendar',
    state: () => ({
        title: '',
        start: '',
        end: ''
    }),
    actions: {
        setPopupInputs({ start, end }) {
            this.title = ''
            this.start = moment(start).format("YYYY-MM-DDTHH:mm")
            this.end = moment(end).format("YYYY-MM-DDTHH:mm")
        }
    }
});
