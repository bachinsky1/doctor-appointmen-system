import { defineStore } from "pinia"
import axios from "axios"

export const useTestStore = defineStore("test", {
    state: () => ({
        data: 'This is data from store',
    }),

    getters: {

    },

    actions: {

    },
})