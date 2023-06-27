<template>
    <Panel>
        <Form id="appointment" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">{{ trans('agenda.new_appointment') }}</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <TextInput :required="true" name="start" v-bind:disabled="mode !== 'new'" v-model="store.currentEvent.title" :label="trans('agenda.labels.appointment_title')" autocomplite="off" />
                </div>
                <div class="sm:col-span-6">
                    <label for="appointmentType" class="text-sm text-gray-500">Select appointment type<span class="text-red-600">*</span></label>
                    <multiselect 
                        v-model="store.currentEvent.extendedProps.type" 
                        :options="types" 
                        :multiple="false" 
                        :close-on-select="true" 
                        :clear-on-select="true" 
                        :preserve-search="false" 
                        placeholder="Select appointment type" 
                        label="name" 
                        track-by="id" 
                        :preselect-first="true"  
                        :loading="isLoading"  
                    >
                    </multiselect> 
                </div>
                <div class="sm:col-span-6">
                    <label for="patient" class="text-sm text-gray-500">Select patient or health professional<span class="text-red-600">*</span></label>
                    <multiselect 
                        v-model="store.currentEvent.extendedProps.patient" 
                        :options="patients" 
                        :multiple="false" 
                        :close-on-select="true" 
                        :clear-on-select="true" 
                        :preserve-search="true" 
                        placeholder="Select patient or health professional" 
                        label="full_name" 
                        track-by="id" 
                        :preselect-first="false" 
                        :loading="isLoading" 
                        @search-change="onSearchEntityChange"
                    >
                    </multiselect>
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" v-bind:disabled="mode !== 'new'" :required="true" name="start" v-model="store.currentEvent.startStr" :label="trans('users.labels.start_time')" />
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" v-bind:disabled="mode !== 'new'" :required="true" name="start" v-model="store.currentEvent.endStr" :label="trans('users.labels.end_time')" />
                </div>
                
                <div class="sm:col-span-6 mt-4 pt-4 border-t flex items-center justify-between gap-x-6">
                    <div>
                        <Button v-if="mode === 'update' && store.currentEvent.extendedProps.approved === 0" @click="handleEventApprove" type="button" :label="trans('global.buttons.approve')" />
                    </div>
                    <div>
                        <Button v-if="mode === 'update' && store.currentEvent.extendedProps.approved === 0" class="ml-5" @click="handleEventRemove" type="button" :label="trans('global.buttons.delete')" />
                        <Button v-if="store.currentEvent.extendedProps.approved === 1" @click="handleCreateConsultation" type="button" :label="trans('global.buttons.consultation')" />
                        <Button v-if="mode === 'new'" :label="trans('global.buttons.submit')" />
                    </div>
                </div>
            </div>
        </Form>
    </Panel>
</template>

<script>

import { reactive, defineComponent, ref } from "vue"
import { useAlertStore, useAuthStore } from "@/stores"
import { trans } from "@/helpers/i18n"
import { getResponseError } from "@/helpers/api"
import Button from "@/views/components/input/Button"
import TextInput from "@/views/components/input/TextInput"
import Panel from "@/views/components/Panel"
import Form from "@/views/components/Form"
import { useAgendaStore } from '@/stores'
import Multiselect from 'vue-multiselect'
import AgendaService from '@/services/AgendaService'


export default {
    emits: ['done'],
    props: {
        onEventChange: Function,
        onEventRemove: Function,
        onEventApprove: Function,
        mode: String,
    },
    components: {
        Form,
        Panel,
        TextInput,
        Button,
        Multiselect,
    },

    data: () => ({
        isLoading: false,
        patients: [],
        types: []
    }),

    methods: {
        onSubmitForm() {
            this.$emit('done', {
                start: this.store.currentEvent.start,
                end: this.store.currentEvent.end,
                title: this.store.currentEvent.title,
                type_id: this.store.currentEvent.type_id,
                extendedProps: this.store.currentEvent.extendedProps
                // entity: this.store.entity,
            })
        },

        async onSearchEntityChange(searchTerm) {
            if (searchTerm === '') return []
            this.isLoading = true
            const service = new AgendaService()
            const response = await service.searchPatient(searchTerm)
            this.patients = response.data
            this.isLoading = false
            // console.log(response.data) 
        },

        handleEventApprove() {
            const e = this.store.getCurrentEvent()
            this.onEventApprove(e)
        },

        handleEventChange() {
            // if (this.onEventChange) {
            //     const e = this.store.getCurrentEvent()
            //     this.onEventChange(e)
            // }
        },

        handleEventRemove() {
            if (this.onEventRemove) {
                const e = this.store.getCurrentEvent()
                this.onEventRemove(e)
            }
        },

        handleCreateConsultation() {
            const e = this.store.getCurrentEvent()
            console.log(e)
            this.$router.push({
                name: 'consultation', params: {
                    id: e.extendedProps.public_id
                }
            })
        }
    },

    

    setup() {
        const form = reactive({})
        const store = useAgendaStore()
        const types = ref([])
        const loadAppointmentTypes = async () => {
            try {
                const service = new AgendaService()
                const response = await service.getAppointmentTypes()
                types.value = response.data 
            } catch (error) {
                console.error(error)
            }
        }

        loadAppointmentTypes()

        return {
            form,
            trans,
            store,
            types
        }
    }


}
</script>