import { defineStore } from "pinia"


export const useStore = defineStore("main", {
    state: () => ({
        someValue: ''
    }),
    getters: {
        getSomeValue(): string {
            return this.someValue
        },
    },
    actions: {
        setSomeValue(value: string) {
            this.someValue = value
        },
    },
})
