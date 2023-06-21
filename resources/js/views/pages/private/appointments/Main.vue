<template>
    <div class="mt-2 grid sm:grid-cols-10">
        <div class="sm:col-span-4">
            <label for="med-institution" class="text-gray-700 font-medium">Medical establishment:</label>
            <select id="med-institution" v-model="selectedMedInst" @change="getDoctors" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                <option value="">Select Medical establishment</option>
                <option v-for="medInst in medInstitutions" :key="medInst.id" :value="medInst.id">{{ medInst.name }}</option>
            </select>
        </div>
        <div class="sm:col-span-4">
            <label for="doctor" class="text-gray-700 font-medium">Health Professional:</label>
            <select id="doctor" v-model="selectedDoctor" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                <option value="">Select Health Professional</option>
                <option v-for="doctor in doctors" :value="doctor.id">{{ doctor.name }}</option>
            </select>
        </div>
    </div>
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
            medicalestablishments: [],
            doctors: [],
            selectedMedInst: '',
            selectedDoctor: ''
        }
    },

    methods: {

        async getMedicalestablishments() {
            const service = new PatientAppointmentSerivce()
            this.medicalestablishments = await service.getMedicalestablishments()
        },

        async getDoctors() {
            console.log(this.selectedMedInst)
            if (!this.selectedMedInst) {
                return
            }
            const service = new PatientAppointmentSerivce()
            this.doctors = await service.getHealthProfessionals(this.selectedMedInst)
        }
    },

    mounted() {
        this.getMedicalestablishments()
    },

    setup() {
        return {
            trans,
        }
    }
})
</script>