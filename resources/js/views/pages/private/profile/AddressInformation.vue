<template>
    <Panel>
        <Form id="edit-address" @submit.prevent="onSubmitForm">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Addresses</h2>
            <div v-for="(address, index) in form" :key="index">
                <div class="row mb-3">
                    <label for="street" class="col-sm-2 col-form-label">Street</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" :id="'street-' + index" :name="'street-' + index" v-model="address.street" required>
                    </div>
                    <label for="house_number" class="col-sm-2 col-form-label">House Number</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" :id="'house_number-' + index" :name="'house_number-' + index" v-model="address.house_number" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="city" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" :id="'city-' + index" :name="'city-' + index" v-model="address.city" required>
                    </div>
                    <label for="state" class="col-sm-1 col-form-label">State</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" :id="'state-' + index" :name="'state-' + index" v-model="address.state" required>
                    </div>
                    <label for="zip_code" class="col-sm-2 col-form-label">Zip Code</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" :id="'zip_code-' + index" :name="'zip_code-' + index" v-model="address.zip_code" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 form-check col-sm-10">
                        <input type="checkbox" class="form-check-input" :id="'is_main_address-' + index" :name="'is_main_address-' + index" v-model="address.is_main_address">
                        <label class="col-sm-2 form-check-label" :for="'is_main_address-' + index">Main Address</label>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-danger" @click="deleteAddress(index)">Delete</button>
                </div>
                <hr>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary" @click="addAddress">Add address</button>
                <button type="submit" class="btn btn-success" @click="onSubmitForm" :disabled="loadingForm">
                    <span v-if="!loadingForm">Update</span>
                    <span v-else>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only disabled"> Updating...</span>
                    </span>
                </button>
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

        },

        async onSubmitForm() {

        },

        async fillForm() {

        },
    },

    mounted() {
        this.fillForm()
    },

    beforeDestroy() {

    }
}
</script>