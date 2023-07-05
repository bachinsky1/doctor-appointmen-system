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
            <div class="border-b border-gray-200 overflow-auto p-3 max-h-40vh  overflow-auto p-3">
                <div v-if="activeTab === 'last'">
                    <ul>
                        <div v-if="lastVitalSignsDate !== null" class="grid grid-cols-2 border-b border-gray-300 py-2">
                            <div>
                                <li>
                                    <span> Measurement date </span>
                                </li>
                                <li>
                                    <span> Consultation created at </span>
                                </li>
                                <li>
                                    <span> Created by </span>
                                </li>
                                <li>
                                    <span> Phone </span>
                                </li>
                            </div>
                            <div>
                                <li>
                                    {{ lastVitalSignsDate }}
                                </li>
                                <li>
                                    {{ lastVitalSignsConsultation.created_at }}
                                </li>
                                <li>
                                    {{ lastVitalSignsUser.full_name }}
                                </li>
                                <li>
                                    {{ lastVitalSignsUser.phone1 }}
                                </li>
                            </div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div>
                                <template v-for="(v, k) in lastVitalSigns">
                                    <li v-if="v.value !== null" :key="k" class="py-2 border-b border-gray-300 last:border-b-0">
                                        {{ trans(k) }}
                                    </li>
                                </template>
                            </div>
                            <div>
                                <template v-for="(v, k) in lastVitalSigns">
                                    <li v-if="v.value !== null" :key="k" class="py-2 border-b border-gray-300 last:border-b-0">
                                        {{ v.value }}
                                        <span class="ml-1 text-gray-400 text-sm">{{ v.unit }}</span>
                                    </li>
                                </template>
                            </div>
                        </div>
                    </ul>
                    <div v-if="!!lastVitalSigns === false" class="flex justify-center items-center"> No last vital signs </div>
                </div>
                <div v-else>
                    <template v-if="historyVitalSigns.length > 0">
                        <div>
                            <ul v-for="historyItem in historyVitalSigns" :key="historyItem.id">
                                <div v-if="lastVitalSignsDate !== null" class="grid grid-cols-2 border-t border-b border-t-gray-400 border-b-gray-300 py-2">
                                    <div>
                                        <li>
                                            <span> Measurement date </span>
                                        </li>
                                        <li>
                                            <span> Consultation created at </span>
                                        </li>
                                        <li>
                                            <span> Created by </span>
                                        </li>
                                        <li>
                                            <span> Phone </span>
                                        </li>
                                    </div>
                                    <div>
                                        <li>
                                            {{ historyItem.created_at }}
                                        </li>
                                        <li>
                                            {{ historyItem.consultation.created_at }}
                                        </li>
                                        <li>
                                            {{ historyItem.user.full_name }}
                                        </li>
                                        <li>
                                            {{ historyItem.user.phone1 }}
                                        </li>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div>
                                        <template v-for="(v, k) in JSON.parse(historyItem.data)">
                                            <li v-if="v.value !== null" :key="k" class="py-2 border-b border-gray-300 last:border-b-0">
                                                {{ trans(k) }}
                                            </li>
                                        </template>
                                    </div>
                                    <div>
                                        <template v-for="(v, k) in JSON.parse(historyItem.data)">
                                            <li v-if="v.value !== null" :key="k" class="py-2 border-b border-gray-300 last:border-b-0">
                                                {{ v.value }}
                                                <span class="ml-1 text-gray-400 text-sm">{{ v.unit }}</span>
                                            </li>
                                        </template>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </template>
                    <div v-else class="flex justify-center items-center"> No history about vital signs </div>
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
                    <li v-for="(vitalSignUnit, index) in vitalSignsUnits" :key="index" class="p-2 border-b">
                        <div class="flex items-center">
                            <div class="w-9/12 flex items-center mr-auto">
                                <i :class="vitalSignUnit.icon" class="mr-1"></i>
                                <span>{{ trans(vitalSignUnit.name) }}</span>
                            </div>
                            <div class="w-3/12 flex items-center">
                                <input :name="`${vitalSignUnit.name}[value]`" type="text" autocomplete="off" class="w-12 border border-gray-300 rounded-sm text-sm py-1 px-2" />
                                <input :name="`${vitalSignUnit.name}[unit]`" type="hidden" :value="vitalSignUnit.unit" />
                                <span class="ml-2 text-gray-400 text-xs">{{ vitalSignUnit.unit }}</span>
                            </div>
                        </div>
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
        <BlockAlert :show="show" :type="type" :message="message" :description="description" @close="show = false" ref="alert" />
    </div>
</template>

<script>
import { getResponseError } from "@/helpers/api"
import { trans } from "@/helpers/i18n"
import VitalSignsService from "@/services/VitalSignsService"
import { useConsultationStore } from "@/stores"
import Form from "@/views/components/Form"
import BlockAlert from "@/views/components/BlockAlert.vue"

export default {
    name: "VitalSigns",
    props: [],
    components: {
        Form,
        BlockAlert,
    },
    data() {
        return {
            activeTab: "last",
            addingVitalSigns: false,
            vitalSignsUnits: [],
            lastVitalSigns: {},
            lastVitalSignsConsultation: {},
            lastVitalSignsUser: {},
            lastVitalSignsDate: '',
            historyVitalSigns: [],
            show: false,
            type: '',
            message: '',
            description: '',
        }
    },

    mounted() {
        setTimeout(() => {
            this.getVitalSigns()
        })

    },

    methods: {
        showSuccess(message, description) {
            const alert = {
                type: 'success',
                message: message || 'Success!',
                description: description,
                show: true
            }

            this.$refs.alert.addAlert(alert)
        },
        showError(message, description) {
            const alert = {
                type: 'error',
                message: message || 'Error!',
                description: description,
                show: true
            }

            this.$refs.alert.addAlert(alert)
        },
        async getVitalSigns() {
            try {
                const patientId = this.consultationStore.currentConsultation.patient_id
                const vitalSignsResponse = await this.vitalSignsService.getVitalSigns(patientId)

                this.lastVitalSigns = vitalSignsResponse.data.last ? JSON.parse(vitalSignsResponse.data.last.data) : null
                this.lastVitalSignsConsultation = vitalSignsResponse.data.last ? vitalSignsResponse.data.last.consultation : null
                this.lastVitalSignsUser = vitalSignsResponse.data.last ? vitalSignsResponse.data.last.user : null
                this.lastVitalSignsDate = vitalSignsResponse.data.last ? vitalSignsResponse.data.last.created_at : null
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
                    const matches = key.match(/^(.+)\[(.+)\]$/)
                    if (matches) {
                        const name = matches[1]
                        const property = matches[2]
                        if (!vitalSignsData[name]) {
                            vitalSignsData[name] = {}
                        }
                        vitalSignsData[name][property] = value
                    } else {
                        vitalSignsData[key] = value
                    }
                }

                vitalSignsData.public_id = this.consultationStore.currentConsultation.public_id

                // Save the vital signs data
                const response = await this.vitalSignsService.saveVitalSigns(vitalSignsData)
                if (!!response.data === true) {
                    this.showSuccess('Success!', 'Record saved successfully!')
                    this.getVitalSigns()
                    this.activeTab = 'last'
                } else {
                    throw new Error(); 
                }
            } catch (error) {
                const { message, description } = getResponseError(error)
                this.showError(message, description)
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