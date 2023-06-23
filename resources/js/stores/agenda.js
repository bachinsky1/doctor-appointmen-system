import { defineStore } from 'pinia'
import moment from 'moment'

export const useAgendaStore = defineStore({
    id: "agenda",

    state: () => ({
        id: "",
        title: "",
        start: "",
        end: "",
        type_id: null,
        entity_id: null,
        mode: "create",
        currentEvent: {},
    }),

    actions: {
        setPopupInputs({ id, title, start, end, type_id, entity_id }) {
            this.id = id;
            this.title = title;
            this.start = moment(start).format("YYYY-MM-DDTHH:mm");
            this.end = moment(end).format("YYYY-MM-DDTHH:mm");
            this.type_id = type_id;
            this.entity_id = entity_id;
        },

        setCurrentEvent(event) {
            this.currentEvent = event;
        },

        getCurrentEvent() {
            return this.currentEvent;
        },

        setMode(mode) {
            this.mode = mode;
        },
    },
});
