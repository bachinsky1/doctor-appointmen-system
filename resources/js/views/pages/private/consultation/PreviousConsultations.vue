<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Previous Consultations</h2>
        </div>
        <div class="border-t border-b border-gray-200 max-h-30vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <ul class="list-none list-inside">
                    <li v-for="(date, index) in Object.keys(consultations)" :key="index" class="border-b border-gray-200 py-2 flex flex-wrap items-center justify-start">
                        <Badge theme="success" class="inline">{{ date }}</Badge>
                        <ul class="list-none ml-4 list-disc list-inside">
                            <li v-for="consultation in consultations[date]" :key="consultation.id" class="py-1">
                                <i class="fas fa-circle text-blue-500 mr-2"></i> {{ consultation.type.name }}
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
import Badge from "@/views/components/Badge"

export default {
    name: 'PreviousConsultations',
    props: [],

    components: {
        Badge
    },

    data() {
        return {
            consultations: {}
        }
    },

    mounted() {
        

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
