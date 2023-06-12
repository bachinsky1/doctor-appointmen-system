<template>
    <div class="card mb-5">
        <div class="card-header">Contact Information</div>
        <div class="card-body">
            <div v-if="formMessage" :class="['alert', formMessageClass, 'alert-dismissible', 'fade', 'show']">
                {{ formMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="formMessage = ''"></button>
            </div>
            <form class="row g-3" id="contactForm" ref="contactForm" @submit.prevent="onSubmitContactForm">
                <input type="hidden" name="_token" :value="csrfToken">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" v-model="contactForm.firstname" class="form-control" id="firstname">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" v-model="contactForm.lastname" class="form-control" id="lastname">
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="example-select" v-model="contactForm.gender">
                        <option v-for="(item, index) in contactForm.genderItems" :key="index" :value="item">{{ item }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" v-model="contactForm.birthdate" class="form-control" id="birthdate">
                </div>
                <div class="col-md-4">
                    <label for="phone1" class="form-label">Main Phone</label>
                    <input type="phone" v-model="contactForm.phone1" class="form-control" id="phone1">
                </div>
                <div class="col-md-4">
                    <label for="phone2" class="form-label">Second Phone</label>
                    <input type="phone" v-model="contactForm.phone2" class="form-control" id="phone2">
                </div>
                <div class="col-md-4">
                    <label for="fax" class="form-label">Fax</label>
                    <input type="phone" v-model="contactForm.fax" class="form-control" id="fax">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" @click="onSubmitContactForm" :disabled="contactForm.loading">
                        <span v-if="!contactForm.loading">Update</span>
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
import { useStore } from './../../store/store'

interface Store {
    setCsrfToken(): void
    getCsrfToken(): () => string
}

export default {
    name: 'ContactInformation',
    components: {

    },
    props: [
        'message',
    ],
    data() {
        return {
            contactForm: {
                loading: false,
                firstname: '',
                lastname: '',
                phone1: '',
                phone2: '',
                fax: '',
                birthdate: '',
                gender: null,
                genderItems: ['M', 'F'],
                isFormChanged: false,
            },
            csrfToken: '',
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: ''
        }
    },

    methods: {
        onFormChange() {
            this.contactForm.isFormChanged = true
        },

        async onSubmitContactForm() {

            if (!this.contactForm.isFormChanged) {
                this.formMessage = 'Form data didn`t change. No need to update.'
                this.formMessageClass = 'alert-warning'
                return
            }

            this.contactForm.loading = true

            try {
                const response = await fetch('/profile/updateContactInfo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    },
                    body: JSON.stringify(this.contactForm)
                })
                const data = await response.json()
                console.log(data)

                this.formMessage = data.message

                this.formMessageClass = response.ok ? 'alert-success' : 'alert-danger'

                if (response.ok) {
                    const { firstname, lastname } = this.contactForm
                    const fullName = `${firstname} ${lastname}`

                    document.querySelectorAll('.currentUserName').forEach(element => element.textContent = fullName)
                    this.contactForm.isFormChanged = false
                }

            } catch (error) {
                console.error(error)
            }

            setTimeout(() => {
                this.formMessage = ''
            }, this.formMessageTimeout)

            this.contactForm.loading = false
        },

        async fillContactInfo() {
            this.contactForm.loading = true

            try {
                const response = await fetch('/profile/getContactInfo', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                })

                if (!response.ok) {
                    throw new Error('Failed to fetch contact info')
                }

                const data = await response.json()

                this.contactForm.firstname = data.firstname
                this.contactForm.lastname = data.lastname
                this.contactForm.phone1 = data.phone1
                this.contactForm.phone2 = data.phone2
                this.contactForm.fax = data.fax
                this.contactForm.birthdate = data.birthdate
                this.contactForm.gender = data.gender

            } catch (error) {
                console.error(error)
            } finally {
                this.contactForm.loading = false
            }
        }
    },

    filters: {

    },

    computed: {

    },

    mounted() {
        
        this.csrfToken = (this.store.getCsrfToken) as string
        console.log(this.csrfToken)

        const formElements = document.querySelectorAll('#contactForm input, #contactForm select')

        formElements.forEach(element => {
            element.addEventListener('input', this.onFormChange)
            element.addEventListener('change', this.onFormChange)
        })

        this.fillContactInfo()
    },

    beforeDestroy() {
        const formElements = document.querySelectorAll('#contactForm input, #contactForm select')

        formElements.forEach(element => {
            element.removeEventListener('input', this.onFormChange)
            element.removeEventListener('change', this.onFormChange)
        })
    },

    setup() {
        const store = useStore()

        store.setCsrfToken()

        return {
            store
        }
    },
}
</script>
