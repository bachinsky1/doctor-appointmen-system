<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3" id="vitalSigns">
        <div class="bg-white rounded-t-lg pl-4 pt-4 pb-2 flex justify-between items-center">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                <button v-if="addingVitalSigns" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2" @click="addingVitalSigns = false;">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button v-if="!addingVitalSigns" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-stethoscope"></i>
                </button> Vital Signs
            </h2>
        </div>
        <div v-if="!addingVitalSigns">
            <div class="flex justify-between border-b border-gray-200">
                <button :class="{ 'bg-blue-500 text-white': activeTab === 'last' }" class="w-1/2 py-1 focus:outline-none" @click="activeTab = 'last'"> Last </button>
                <button :class="{ 'bg-blue-500 text-white': activeTab === 'history' }" class="w-1/2 py-1 focus:outline-none" @click="activeTab = 'history'"> History </button>
            </div>
            <div class="border-t border-b border-gray-200 overflow-auto p-3">
                <div v-if="activeTab === 'last'">
                    <ul>
                        <template v-for="(value, key) in lastVitalSigns">
                            <li v-if="value !== null" :key="key">{{ trans(key) }}: {{ value }}</li>
                        </template>
                    </ul>
                    <div v-if="!!lastVitalSigns === false" class="flex justify-center items-center">
                        No last vital signs
                    </div>
                </div>
                <div v-else>
                    <template v-if="historyVitalSigns.length > 0">
                        <ul v-for="historyItem in historyVitalSigns">
                            <template v-for="(value, key) in JSON.parse(historyItem.data)">
                                <li v-if="value !== null" :key="key">{{ trans(key) }}: {{ value }}</li>
                            </template>
                        </ul>
                    </template>
                    <div v-else class="flex justify-center items-center">
                        No history about vital signs
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                <button class="bg-blue-500 text-white py-1 px-2 rounded-md focus:outline-none" @click="addingVitalSigns = true">
                    <i class="fas fa-plus-circle"></i> Add vital signs </button>
            </div>
        </div>
        <div v-else>
            <Form id="vitalSignsForm" @submit.prevent="onSubmitForm">
                <ul class="border-t border-gray-200 overflow-auto p-3">
                    <li v-for="(vitalSignUnit, index) in vitalSignsUnits" :key="index" class="p-2 border-b flex items-center">
                        <i :class="vitalSignUnit.icon" class="mr-1"></i>
                        <span class="mr-2">{{ trans(vitalSignUnit.name) }} </span>
                        <input :name="vitalSignUnit.name" type="text" autocomplete="off" class="w-12 border border-gray-300 rounded-sm text-sm py-1 px-2 ml-auto" />
                        <span class="ml-2 text-gray-400 text-xs">{{ vitalSignUnit.unit }}</span>
                    </li>
                </ul>
                <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                    <button class="bg-orange-500 text-white py-1 px-2 rounded-md focus:outline-none" @click="addingVitalSigns = false">
                        <i class="fas fa-times-circle"></i> Cancel </button>
                    <button class="bg-blue-500 text-white py-1 px-2 rounded-md focus:outline-none ml-2" type="submit">
                        <i class="fas fa-save"></i> Save </button>
                </div>
            </Form>
        </div>
    </div>
</template>

<script>
import { getResponseError } from "@/helpers/api"
import { trans } from "@/helpers/i18n"
import VitalSignsService from '@/services/VitalSignsService'
import { useConsultationStore } from '@/stores'
import Form from "@/views/components/Form"

export default {
    name: "VitalSigns",
    props: [],
    components: {
        Form,
    },
    data() {
        return {
            activeTab: "last",
            addingVitalSigns: false,
            vitalSignsUnits: [],
            lastVitalSigns: {},
            historyVitalSigns: [],
        }
    },

    mounted() {
        setTimeout(() => {
            this.getVitalSigns()
        })

    },

    methods: {
        async getVitalSigns() {
            try {
                const patientId = this.consultationStore.currentConsultation.patient_id
                const vitalSignsResponse = await this.vitalSignsService.getVitalSigns(patientId)

                this.lastVitalSigns = vitalSignsResponse.data.last ? JSON.parse(vitalSignsResponse.data.last.data) : null
                this.historyVitalSigns = vitalSignsResponse.data.history

                const unitsResponse = await this.vitalSignsService.getUnits()
                this.vitalSignsUnits = unitsResponse.data
            } catch (error) {
                console.error(error)
            }
        },
        async onSubmitForm() {
            try {
                const formData = new FormData(document.querySelector('#vitalSignsForm'))

                // Convert the form data to an object
                const vitalSignsData = {}
                for (const [key, value] of formData.entries()) {
                    vitalSignsData[key] = value
                }

                vitalSignsData.public_id = this.consultationStore.currentConsultation.public_id

                // Save the vital signs data
                await this.vitalSignsService.saveVitalSigns(vitalSignsData)
                this.getVitalSigns()
                this.activeTab = 'last'

            } catch (error) {
                console.error(error)
            }
            this.addingVitalSigns = false
        },
    },

    setup() {

        const consultationStore = useConsultationStore()
        const vitalSignsService = new VitalSignsService()

        return {
            consultationStore,
            vitalSignsService,
            trans,
        }
    }
}
</script>