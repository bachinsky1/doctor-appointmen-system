import { defineStore } from 'pinia';
import moment from 'moment';
export const useCalendarStore = defineStore({
    id: 'calendar',
    state: () => ({
        start: '',
        end: ''
    }),
    actions: {
        setPopupInputs({ start, end }) {
            this.start = moment(start).format("YYYY-MM-DDTHH:mm");
            this.end = moment(end).format("YYYY-MM-DDTHH:mm");
        }
    }
});
