<template>
    <Panel>
        <Form id="appointment" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">New Appointment</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" :required="true" name="start" v-model="start" :label="trans('users.labels.start_time')" />
                </div>
                <div class="sm:col-span-3">
                    <TextInput type="datetime-local" :required="true" name="start" v-model="end" :label="trans('users.labels.end_time')" />
                </div>
                <div class="sm:col-span-6">
                    <Button />
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

export default {
    emits: ['done'],

    components: {
        Form,
        Panel,
        TextInput,
        Button,
    },

    data: () => ({
        start: '',
        end: '',
    }),

    methods: {

    },
    setup(props, { emit }) {
        const alertStore = useAlertStore()
        const authStore = useAuthStore()
        const form = reactive({})

        const onSubmitForm = () => {
            emit('done');
        }

        const onChange = (event) => {
        }

        return {
            onSubmitForm,
            form,
            trans
        }
    }


}
</script>