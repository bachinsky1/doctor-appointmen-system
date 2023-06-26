<template>
    <Panel>
        <Form id="appointment" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">{{ trans('agenda.new_appointment') }}</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <TextInput :required="true" name="start" v-bind:disabled="mode !== 'new'" v-model="store.title" :label="trans('agenda.labels.appointment_title')" autocomplite="off" />
                </div>
                <div class="sm:col-span-6">
                    <label for="appointmentType" class="text-sm text-gray-500">Select appointment type<span class="text-red-600">*</span></label>
                    <select required="true" id="appointmentType" v-bind:disabled="mode !== 'new'" v-model="store.type_id" v-bind:value="store.type_id" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                        <option v-for="aType in appointmentTypes" :key="aType.id" :value="aType.id">{{ aType.name }}</option>
                    </select>
                </div>
                <div class="sm:col-span-6">
                    <label for="patient" class="text-sm text-gray-500">Select patient or health professional<span class="text-red-600">*</span></label>
                    <multiselect v-model="store.entity" :options="patients" :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" placeholder="Select patient or health professional" label="full_name" track-by="id" :preselect-first="false" :loading="isLoading" @search-change="onSearchChange">
                    </multiselect>
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" v-bind:disabled="mode !== 'new'" :required="true" name="start" v-model="store.start" :label="trans('users.labels.start_time')" />
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" v-bind:disabled="mode !== 'new'" :required="true" name="start" v-model="store.end" :label="trans('users.labels.end_time')" />
                </div>
                <div class="sm:col-span-6 mt-4 pt-4 border-t flex items-center justify-end gap-x-6">
                    <!-- <Button v-if="mode === 'update'" class="ml-5" @click="handleEventChange" type="button" :label="trans('global.buttons.update')" /> -->
                    <Button v-if="mode === 'update'" class="ml-5" @click="handleEventRemove" type="button" :label="trans('global.buttons.delete')" />
                    <Button v-if="mode === 'new'" :label="trans('global.buttons.submit')" />
                </div>
            </div>
        </Form>
    </Panel>
</template>

<script>

import { reactive, defineComponent } from "vue"
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
        mode: String,
        appointmentTypes: Array,
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
        patients: []
    }),

    methods: {
        onSubmitForm() {
            this.$emit('done', {
                start: this.store.start,
                end: this.store.end,
                title: this.store.title,
                type_id: this.store.type_id,
                entity: this.store.entity,
            })
        },

        async onSearchChange(searchTerm) {
            if (searchTerm === '') return []
            this.isLoading = true
            const service = new AgendaService()
            const response = await service.searchPatient(searchTerm)
            this.patients = response.data
            this.isLoading = false
            // console.log(response.data) 
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
        }

    },

    setup() {
        const form = reactive({})
        const store = useAgendaStore()

        return {
            form,
            trans,
            store
        }
    }


}
</script>