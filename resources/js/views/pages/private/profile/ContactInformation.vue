<template>
    <Panel>
        <Form id="edit-contact" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <TextInput type="text" :required="true" name="first_name" v-model="form.first_name" :label="trans('users.labels.first_name')" autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" :required="true" name="first_name" v-model="form.last_name" :label="trans('users.labels.last_name')" autocomplete="off" />
                </div>
                <div class="sm:col-span-1">
                    <TextInput type="date" :required="true" name="birthdate" v-model="form.birthdate" :label="trans('users.labels.birthdate')" autocomplete="off" />
                </div>
                <div class="sm:col-span-1">
                    <label for="first-name" class="text-sm text-gray-500">Gender</label>
                    <select v-model="form.gender" id="gender" name="gender" autocomplete="gender" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                        <option v-for="(item, index) in form.genderItems" :key="index" :value="item">{{ item }}</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" :required="true" name="birthdate" v-model="form.phone1" :label="trans('users.labels.main_phone')" autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" name="phone2" v-model="form.phone1" :label="trans('users.labels.second_phone')" autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" name="fax" v-model="form.fax" :label="trans('users.labels.fax')" autocomplete="off" />
                </div>
                <div class="sm:col-span-6 mt-1 flex items-center justify-end gap-x-6">
                    <Button :label="trans('global.buttons.submit')" />
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
    name: 'ContactInformation',
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
    props: {},

    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                phone1: '',
                phone2: '',
                fax: '',
                birthdate: null,
                gender: null,
                genderItems: ['M', 'F']
            },
        }
    },

    mounted() {
        console.log('mounted')
        this.fillForm()

    },

    setup: () => {
        return {
            trans
        }
    },

    methods: {

        onFormChange() {

        },

        async onSubmitForm() {
            const service = new ProfileService()
            const alertStore = useAlertStore()

            try {
                const response = await service.updateContactInformation(this.form)
                const data = response.data
                console.log(data)
                const store = useAuthStore()
                store.getCurrentUser()
                alertStore.success(response.data.message)
            } catch (error) {

                alertStore.error(getResponseError(error))
                console.log(error)
            }
        }
        ,

        async fillForm(params) {
            const service = new ProfileService()
            try {
                const response = await service.getContactInformation()
                const data = response.data
                this.form.first_name = data.first_name
                this.form.last_name = data.last_name
                this.form.phone1 = data.phone1
                this.form.phone2 = data.phone2
                this.form.fax = data.fax
                this.form.birthdate = data.birthdate
                this.form.gender = data.gender
            } catch (error) {
                console.log(error)
            }
        }
        ,
    },

    filters: {},

    computed: {},


    beforeDestroy() {

    },

}
</script>