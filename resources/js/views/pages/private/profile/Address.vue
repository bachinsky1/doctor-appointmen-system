<template>
    <Panel>
        <Form id="add-address" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Addresses</h2>
            <div v-for="(address, index) in form" :key="index" class="mb-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <TextInput type="text" :required="true" :id="'street-' + index" :name="'street-' + index" v-model="address.street" :label="trans('users.labels.street')" autocomplete="off" />
                </div>
                <div class="sm:col-span-1">
                    <TextInput type="text" :required="true" :id="'house_number-' + index" :name="'house_number-' + index" v-model="address.house_number" :label="trans('users.labels.house_number')" autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" :required="true" :id="'city-' + index" :name="'city-' + index" v-model="address.city" :label="trans('users.labels.city')" autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <TextInput type="text" :required="true" :id="'state-' + index" :name="'state-' + index" v-model="address.state" :label="trans('users.labels.state')" autocomplete="off" />
                </div>
                <div class="sm:col-span-1">
                    <TextInput type="text" :required="true" :id="'zip_code-' + index" :name="'zip_code-' + index" v-model="address.zip_code" :label="trans('users.labels.zip_code')" autocomplete="off" />
                </div>
                <div class="mt-6 sm:col-span-1">
                    <label class="text-sm text-gray-500" :for="'is_main_address-' + index">{{ trans('users.labels.main_address') }} </label>
                    <input type="checkbox" :id="'is_main_address-' + index" :name="'is_main_address-' + index" v-model="address.is_main_address" class="ml-2 default:ring-2" />
                </div>
                <div class="sm:col-span-1">
                    <label for="gender" class="text-sm text-gray-500">&nbsp;</label><br>
                    <Button @click="deleteAddress(index)" :label="trans('global.buttons.delete')" />
                </div>
            </div>
            <div class="sm:col-span-6 mt-4 pt-4 flex items-center justify-end gap-x-6 border-t">
                <Button class="ml-5" @click="addAddress" type="button" :label="trans('global.buttons.add')" />
                <Button @click="onSubmitForm" :label="trans('global.buttons.submit')" />
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
            form: [
                {
                    street: '',
                    house_number: '',
                    city: '',
                    state: '',
                    zip_code: '',
                    is_main_address: false
                }
            ],
        }
    },

    methods: {
        addAddress() {
            this.form.push({
                street: '',
                house_number: '',
                city: '',
                state: '',
                zip_code: '',
                is_main_address: false
            })
        },

        deleteAddress(index) {
            this.form.splice(index, 1)
        },

        async onSubmitForm() {

            const service = new ProfileService()
            const alertStore = useAlertStore()
            try {
                const response = await service.updateAddress({ addresses: this.form })
                alertStore.success(response.data.message)
            } catch (error) {
                alertStore.error(getResponseError(error))
            }

        },

        async fillForm() {
            const service = new ProfileService()
            const alertStore = useAlertStore()
            try {
                const response = await service.getAddress()
                this.form = response.data.map((address) => ({
                    street: address.street,
                    house_number: address.house_number,
                    city: address.city,
                    state: address.state,
                    zip_code: address.zip_code,
                    is_main_address: !!address.is_main_address
                }))
            } catch (error) {
                alertStore.error(getResponseError(error))
            }
        },
    },

    mounted() {
        this.fillForm()
    },

    setup: () => {
        return {
            trans
        }
    },

    beforeDestroy() {

    }
}
</script>