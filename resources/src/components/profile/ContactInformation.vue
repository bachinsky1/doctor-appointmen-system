<template>
    <div class="card mb-4">
        <div class="card-header">Contact Information</div>
        <div class="card-body">
            <div v-if="formMessage" :class="['alert', formMessageClass, 'alert-dismissible', 'fade', 'show']">
                {{ formMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="formMessage = ''"></button>
            </div>
            <form class="row g-3" id="contactForm" ref="contactForm" @submit.prevent="onSubmitForm">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" v-model="form.firstname" :class="{ 'is-invalid': v.form.firstname.$error }" class="form-control" id="firstname" autocomplete="off">
                    <div class="invalid-feedback" v-if="v.form.firstname.$error">Field is invalid</div>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" v-model="form.lastname" :class="{ 'is-invalid': v.form.lastname.$error }" class="form-control" id="lastname" autocomplete="off">
                    <div class="invalid-feedback" v-if="v.form.lastname.$error">Field is invalid</div>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="example-select" v-model="form.gender">
                        <option v-for="(item, index) in form.genderItems" :key="index" :value="item">{{ item }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" v-model="form.birthdate" :class="{ 'is-invalid': v.form.birthdate.$error }" class="form-control" id="birthdate" autocomplete="off">
                    <div class="invalid-feedback" v-if="v.form.birthdate.$error">Field is invalid</div>
                </div>
                <div class="col-md-4">
                    <label for="phone1" class="form-label">Main Phone</label>
                    <input type="phone" v-model="form.phone1" :class="{ 'is-invalid': v.form.phone1.$error }" class="form-control" id="phone1" autocomplete="off">
                    <div class="invalid-feedback" v-if="v.form.phone1.$error">Field is invalid</div>
                </div>
                <div class="col-md-4">
                    <label for="phone2" class="form-label">Second Phone</label>
                    <input type="phone" v-model="form.phone2" class="form-control" id="phone2" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label for="fax" class="form-label">Fax</label>
                    <input type="phone" v-model="form.fax" class="form-control" id="fax" autocomplete="off">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success" @click="onSubmitForm" :disabled="loadingForm">
                        <span v-if="!loadingForm">Update</span>
                        <span v-else>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only disabled"> Updating...</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">

import { required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'

interface Form {
    firstname: string,
    lastname: string,
    phone1: string,
    phone2: string,
    fax: string,
    birthdate: Date | null,
    gender: string | null,
    genderItems: ['M', 'F']
}

export default {
    name: 'ContactInformation',
    components: {},
    props: {},

    data() {
        return {
            form: {
                firstname: '',
                lastname: '',
                phone1: '',
                phone2: '',
                fax: '',
                birthdate: null,
                gender: null,
                genderItems: ['M', 'F']
            } as Form,

            loadingForm: false,
            isFormChanged: false,
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: '',
        }
    },

    setup: () => ({ v: useVuelidate() }),

    validations() {
        return {
            form: {
                firstname: { required },
                lastname: { required },
                birthdate: { required },
                phone1: { required },
            }
        }
    },

    methods: {
        onFormChange() {
            this.isFormChanged = true
        },

        async onSubmitForm() {

            const isFormCorrect = await this.v.$validate()

            if (!isFormCorrect || !this.isFormChanged) {
                return
            }

            this.loadingForm = true

            try {

                const response = await axios.post('/profile/updateContact', this.form)

                this.formMessage = response.data.message
                this.formMessageClass = response.status === 200 ? 'alert-success' : 'alert-danger'

                if (response.status === 200) {
                    const { firstname, lastname } = this.form
                    const fullName = `${firstname} ${lastname}`
                    document.querySelectorAll('.currentUserName').forEach(element => element.textContent = fullName)
                    this.isFormChanged = false
                }

            } catch (error) {
                console.error(error)
            }

            setTimeout(() => {
                this.formMessage = ''
            }, this.formMessageTimeout)

            this.loadingForm = false
        },

        async fillForm() {
            this.loadingForm = true

            try {
                const response = await axios.get('/profile/getContact', {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                const data = response.data

                this.form.firstname = data.firstname
                this.form.lastname = data.lastname
                this.form.phone1 = data.phone1
                this.form.phone2 = data.phone2
                this.form.fax = data.fax
                this.form.birthdate = data.birthdate
                this.form.gender = data.gender

            } catch (error) {
                console.error(error)
            } finally {
                this.loadingForm = false
            }
        }
    },

    filters: {},

    computed: {},

    mounted() {
        const formElements = document.querySelectorAll('#contactForm input, #contactForm select')

        formElements.forEach(element => {
            element.addEventListener('input', this.onFormChange)
            element.addEventListener('change', this.onFormChange)
        })

        this.fillForm()
    },

    beforeDestroy() {
        const formElements = document.querySelectorAll('#contactForm input, #contactForm select')

        formElements.forEach(element => {
            element.removeEventListener('input', this.onFormChange)
            element.removeEventListener('change', this.onFormChange)
        })
    },

}
</script>
