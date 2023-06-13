<template>
    <div class="card mb-4">
        <div class="card-header">Addresses</div>
        <div class="card-body">
            <div v-if="formMessage" :class="['alert', formMessageClass, 'alert-dismissible', 'fade', 'show']">
                {{ formMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="formMessage = ''"></button>
            </div>
            <form class="row g-3" id="addressForm" ref="contactForm" @submit.prevent="onSubmitForm">
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
                    <button type="button" class="btn btn-danger" @click="deleteAddress(index)">Delete address</button>
                    <hr>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-success" @click="onSubmitForm" :disabled="loadingForm">
                        <span v-if="!loadingForm">Update</span>
                        <span v-else>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only disabled"> Updating...</span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" @click="addAddress">Add address</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">

export default {
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
            loadingForm: false,
            isFormChanged: false,
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: ''
        }
    },

    methods: {
        onFormChange() {
            this.isFormChanged = true
        },

        addAddress() {
            this.form.push({
                street: '',
                house_number: '',
                city: '',
                state: '',
                zip_code: '',
                is_main_address: false
            })

            this.$nextTick(() => {
                const formElements = document.querySelectorAll('#addressForm input, #addressForm select')

                formElements.forEach(element => {
                    element.addEventListener('input', this.onFormChange)
                    element.addEventListener('change', this.onFormChange)
                })

                this.onFormChange
            })
        },

        deleteAddress(index: number) {
            this.form.splice(index, 1)

            const formElements = document.querySelectorAll('#addressForm input, #addressForm select')

            formElements.forEach(element => {
                element.removeEventListener('input', this.onFormChange)
                element.removeEventListener('change', this.onFormChange)
            })

            this.$nextTick(() => {
                formElements.forEach((element, index) => {
                    element.addEventListener('input', this.onFormChange)
                    element.addEventListener('change', this.onFormChange)
                })
            })

            this.onFormChange()
        },

        async onSubmitForm() {

            if (!this.isFormChanged) {
                this.formMessage = 'Form data didn`t change. No need to update.'
                this.formMessageClass = 'alert-warning'
                return
            }

            this.loadingForm = true

            const data = { addresses: this.form }

            try {
                const response = await axios.post('/profile/updateAddress', data)

                console.log(response.data)

                this.formMessage = response.data.message
                this.formMessageClass = response.status === 200 ? 'alert-success' : 'alert-danger'

                if (response.status === 200) {
                    this.isFormChanged = false
                }
            } catch (error) {
                this.formMessage = error as string
                this.formMessageClass = 'alert-danger'
                console.error('There was an error submitting the form:', error)
            }

            this.fillForm()

            setTimeout(() => {
                this.formMessage = ''
            }, this.formMessageTimeout)

            this.loadingForm = false
        },

        async fillForm() {
            try {

                const response = await axios.get('/profile/getAddress')

                this.form = response.data.map((address: Address) => ({
                    street: address.street,
                    house_number: address.house_number,
                    city: address.city,
                    state: address.state,
                    zip_code: address.zip_code,
                    is_main_address: !!address.is_main_address
                }))

            } catch (error) {
                console.error('There was an error getting the addresses:', error)
            } finally {
                this.loadingForm = false
            }
        }
    },

    mounted() {
        const formElements = document.querySelectorAll('#addressForm input, #addressForm select')

        formElements.forEach(element => {
            element.addEventListener('input', this.onFormChange)
            element.addEventListener('change', this.onFormChange)
        })

        this.fillForm()
    },

    beforeDestroy() {
        const formElements = document.querySelectorAll('#addressForm input, #addressForm select')

        formElements.forEach(element => {
            element.removeEventListener('input', this.onFormChange)
            element.removeEventListener('change', this.onFormChange)
        })
    },
}

</script>
