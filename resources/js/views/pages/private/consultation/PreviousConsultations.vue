<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Previous Consultations</h2>
        </div>
        <div class="border-t border-b border-gray-200 max-h-20vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <ul>
                    <li v-for="(date, index) in Object.keys(consultations)" :key="index">
                        <h3>{{ date }}</h3>
                        <ul>
                            <li v-for="consultation in consultations[date]" :key="consultation.id">
                                {{ consultation.type.name }}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, reactive } from "vue"
import { trans } from "@/helpers/i18n"
import { getResponseError } from "@/helpers/api"
import { useConsultationStore } from "@/stores"
import { useAlertStore } from "@/stores"
import ConsultationService from "@/services/ConsultationService" 

export default {
    name: 'PreviousConsultations',
    props: [],

    data() {
        return {
            consultations: {}
        }
    },

    mounted() {
        console.log('Component mounted.')

        setTimeout(async () => {
            try {
                const data = { public_id: this.consultationStore.currentConsultation.public_id }
                const response = await this.consultationService.getPrevious(data)
                this.consultations = response.data
                console.log(response.data)
            } catch (error) {
                console.error(error)
            }
        })

    },

    methods: {
        
    },


    setup() {

        const consultationStore = useConsultationStore()
        const alertStore = useAlertStore()
        const consultationService = new ConsultationService()

        return {
            consultationStore,
            alertStore,
            consultationService
        }
    }
}
</script>
