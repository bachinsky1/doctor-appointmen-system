import { defineStore } from "pinia"


export const useStore = defineStore("main", {
    state: (): { csrfToken: string } => ({
        csrfToken: '',
    }),
    getters: {
        getCsrfToken(): string {
            return this.csrfToken
        },
    },
    actions: {
        setCsrfToken() {
            
            const csrf = document.querySelector('meta[name="csrf-token"]')

            if (csrf !== null) {
                this.csrfToken = csrf.getAttribute("content") || '' 
            } else {
                throw new Error("CSRF meta tag not found")
            }
        },
    },
})
