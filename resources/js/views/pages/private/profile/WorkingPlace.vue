<template>
    <Panel>
        <Form id="edit-workingplace" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Working place</h2>
            <div v-for="(workplace, index) in workplaces" :key="index" class="mt-2 grid grid-cols-1 gap-x-10 gap-y-10 sm:grid-cols-10">
                <div class="sm:col-span-4">
                    <label for="gender" class="text-sm text-gray-500">Position</label>
                    <select id="position" v-model="workplace.position_id" required class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                        <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                    </select>
                </div>
                <div class="sm:col-span-4">
                    <label for="gender" class="text-sm text-gray-500">Medicalestablishment</label>
                    <select id="medical-establishment" v-model="workplace.medicalestablishment_id" required class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm">
                        <option v-for="medicalestablishment in medicalestablishments" :key="medicalestablishment.id" :value="medicalestablishment.id">{{ medicalestablishment.name }}</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="gender" class="text-sm text-gray-500">&nbsp;</label><br>
                    <Button @click="deleteWorkplace(index)" :label="trans('global.buttons.delete')" />
                </div>
            </div>
            <div class="sm:col-span-6 mt-4 pt-4 border-t flex items-center justify-end gap-x-6">
                <Button class="ml-5" @click="addWorkplace" type="button" :label="trans('global.buttons.add')" />
                <Button :label="trans('global.buttons.submit')" />
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
import Panel from "@/views/components/Panel"
import Page from "@/views/layouts/Page"
import Form from "@/views/components/Form"

export default {

    components: {
        Form,
        Panel,
        TextInput,
        Button,
    },

    data() {
        return {
            workplaces: [],
            positions: [],
            medicalestablishments: [],
            userId: null,
        }
    },


    methods: {
        async onFormChange() {

        },

        async fillForm() {
            const service = new ProfileService()
            const alertStore = useAlertStore()
            try {
                const response = await service.getWorkingPlace()
                const data = response.data
                this.workplaces = response.data.workplaces
                this.positions = response.data.positions
                this.medicalestablishments = response.data.medicalestablishments
                this.userId = response.data.userId
            } catch (error) {
                alertStore.error(getResponseError(error))
            }
        },

        addWorkplace() {
            this.workplaces.push({
                user_id: this.userId,
                position_id: undefined,
                medicalestablishment_id: undefined
            })
        },

        deleteWorkplace(index) {
            this.workplaces.splice(index, 1)
        },

        async onSubmitForm() {

            const service = new ProfileService()
            const alertStore = useAlertStore()
            try {
                const response = await service.updateWorkingPlace({ workplaces: this.workplaces })
                alertStore.success(response.data.message)
            } catch (error) {
                alertStore.error(getResponseError(error))
            }

        },
    },

    setup: () => {
        return {
            trans
        }
    },

    mounted() {
        this.fillForm()
    },

    beforeDestroy() {

    },
}
</script>