<template>
    <Page>
        <div class="w-1/2 m-auto text-center pt-10">
            <h1 class="text-6xl mb-4 font-bold text-gray-600">Appointments</h1>
        </div>
    </Page>
</template>

<script>

import { defineComponent, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import Page from "@/views/layouts/Page"
import PatientAppointmentSerivce from '@/services/PatientAppointmentService'

export default defineComponent({
    components: {
        Page,
    },

    data() {
        return {
            medInstitutions: [],
            doctors: [],
            selectedMedInst: '',
            selectedDoctor: ''
        }
    },

    methods: {

    },

    async mounted() {
        const service = new PatientAppointmentSerivce()
        const medests = await service.getMedicalestablishments()
        const medacts = await service.getHealthProfessionals(1)

        console.log(medests.data, medacts.data)
    },

    setup() {
        return {
            trans
        }
    }
})
</script>