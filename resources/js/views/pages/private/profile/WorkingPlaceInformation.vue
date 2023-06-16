<template>
    <Panel>
        <Form id="edit-workingplace" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Working place</h2>
            <div v-for="(workplace, index) in workplaces" :key="index" class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <label for="gender" class="form-label">Position</label>
                    <select class="form-select" id="position" v-model="workplace.position_id" required>
                        <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="gender" class="form-label">Medicalestablishment</label>
                    <select class="form-select" id="medical-establishment" v-model="workplace.medicalestablishment_id" required>
                        <option v-for="medicalestablishment in medicalestablishments" :key="medicalestablishment.id" :value="medicalestablishment.id">{{ medicalestablishment.name }}</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <Button type="button" :label="trans('global.buttons.delete')" />
                </div>
            </div>
        </Form>
    </Panel>
</template>

<script>

import { watch, onMounted, defineComponent, reactive, ref } from 'vue'
import { useAuthStore } from "@/stores/auth"
import { useAlertStore } from "@/stores"
import { trans } from "@/helpers/i18n";
import { getResponseError } from "@/helpers/api"
import ProfileService from "@/services/ProfileService"
import Button from "@/views/components/input/Button"
import TextInput from "@/views/components/input/TextInput"
import Dropdown from "@/views/components/input/Dropdown"
import Alert from "@/views/components/Alert"
import Panel from "@/views/components/Panel"
import Page from "@/views/layouts/Page"
import FileInput from "@/views/components/input/FileInput"
import Form from "@/views/components/Form"

export default {

    components: {
        Form,
        FileInput,
        Panel,
        Alert,
        Dropdown,
        TextInput,
        Button,
        Page
    },

    data() {
        return {
            workplaces: [],
            positions: [],
            medicalestablishments: [],
            userId: null,
            loadingForm: false,
            isFormChanged: false,
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: ''
        }
    },


    methods: {
        onFormChange() {

        },

        async fillForm() {


        },

        addWorkplace() {

        },

        deleteWorkplace(index) {

        },

        async onSubmitForm() {

        },
    },

    setup: () => {
        return {
            trans
        }
    },

    mounted() {

    },

    beforeDestroy() {

    },
}
</script>