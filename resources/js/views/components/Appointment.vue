<template>
    <Panel>
        <Form id="appointment" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">{{ trans('agenda.new_appointment') }}</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <TextInput :required="true" name="start" v-model="store.title" :label="trans('agenda.labels.appointment_title')" autocomplite="off" />
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" :required="true" name="start" v-model="store.start" :label="trans('users.labels.start_time')" />
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" :required="true" name="start" v-model="store.end" :label="trans('users.labels.end_time')" />
                </div>
                <div class="sm:col-span-6">
                    <Button />
                </div>
            </div>
        </Form>
        <!-- <Button @click="handleEventChange" /> -->
        <Button @click="handleEventRemove" :label="trans('global.buttons.delete')" />
    </Panel>
</template>

<script>

import { reactive, defineComponent } from 'vue'
import { useAlertStore, useAuthStore } from '@/stores'
import { trans } from '@/helpers/i18n'
import { getResponseError } from '@/helpers/api'
import Button from '@/views/components/input/Button'
import TextInput from '@/views/components/input/TextInput'
import Panel from '@/views/components/Panel'
import Form from '@/views/components/Form'
import { useCalendarStore } from '@/stores'

export default {

    emits: ['done'],

    props: {
        onEventChange: Function,
        onEventRemove: Function
    },

    components: {
        Form,
        Panel,
        TextInput,
        Button,
    },

    data: () => ({}),

    methods: {
        onSubmitForm() {
            const store = useCalendarStore()

            this.$emit('done', {
                start: store.start,
                end: store.end,
                title: store.title,
            });

        },

        handleEventChange() {
            if (this.onEventChange) {
                const e = this.store.getCurrentEvent()
                this.onEventChange(e)
            }
        },

        handleEventRemove() {
            if (this.onEventRemove) {
                const e = this.store.getCurrentEvent()
                this.onEventRemove(e)
            }
        }
    },

    setup(props, { emit }) {
        // const alertStore = useAlertStore()
        // const authStore = useAuthStore()
        // const form = reactive({})
        const store = useCalendarStore()

        return {
            // form,
            trans,
            store
        }
    }


}
</script>