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
                <div v-if="activeTab === 'last'">Last vital signs</div>
                <div v-else>History of vital signs</div>
            </div>
            <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                <button class="bg-blue-500 text-white py-1 px-2 rounded-md focus:outline-none" @click="addingVitalSigns = true">
                    <i class="fas fa-plus-circle"></i> Add vital signs </button>
            </div>
        </div>
        <div v-else>
            <Form id="vitalSignsForm" @submit.prevent="onSubmitForm">
                <ul class="border-t border-gray-200 overflow-auto p-3">
                    <li v-for="(vitalSign, index) in vitalSigns" :key="index" class="p-2 border-b flex items-center">
                        <i :class="vitalSign.icon" class="mr-1"></i>
                        <span class="mr-2">{{ trans(vitalSign.name) }} </span>
                        <input :name="vitalSign.name" type="text" class="w-12 border border-gray-300 rounded-sm text-sm py-1 px-2 ml-auto" />
                        <span class="ml-2 text-gray-400 text-xs">{{ vitalSign.unit }}</span>
                    </li>
                </ul>
                
                <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                    <button class="bg-orange-500 text-white py-1 px-2 rounded-md focus:outline-none" @click="addingVitalSigns = false">
                        <i class="fas fa-times-circle"></i> Cancel </button>
                    <button class="bg-blue-500 text-white py-1 px-2 rounded-md focus:outline-none ml-2" @click="onSubmitForm">
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
            vitalSigns: [],
        }
    },

    async mounted() {
        try {
            const response = await this.vitalSignsService.getUnits()
            this.vitalSigns = response.data
        } catch (error) {
            console.error(error)
        }
    },

    methods: {
        async onSubmitForm() {
            try {
                console.log(document.querySelector('#vitalSignsForm'))
                const formData = new FormData(document.querySelector('#vitalSignsForm'))

                // Convert the form data to an object
                const vitalSignsData = {}
                for (const [key, value] of formData.entries()) {
                    vitalSignsData[key] = value
                }
                
                // Save the vital signs data
                const response = await this.vitalSignsService.saveVitalSigns(vitalSignsData)
                console.log(response.data)
                // Update the consultation store with the new vital signs data
                // this.consultationStore.updateVitalSigns(vitalSignsData)
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