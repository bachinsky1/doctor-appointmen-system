import { defineStore } from "pinia"


export const useConsultationStore = defineStore({
    id: "consultation",

    state: () => ({
        currentPatient: {},
        currentConsultation: {},
    }),

    actions: {
        setCurrentPatient(patient) {
            this.currentPatient = patient
        },

        getCurrentPatient() {
            return this.currentPatient
        },

        setCurrentConsultation(consultation) {
            this.currentConsultation = consultation
        },

        getCurrentConsultation() {
            return this.currentConsultation
        },
    },
});
