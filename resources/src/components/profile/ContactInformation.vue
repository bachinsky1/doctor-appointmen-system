<template>
    <div class="card mb-5">
        <div class="card-header">Contact Information</div>
        <div class="card-body">
            <div v-if="formMessage" :class="['alert', formMessageClass, 'alert-dismissible', 'fade', 'show']">
                {{ formMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="formMessage = ''"></button>
            </div>
            <form class="row g-3" id="contactForm" ref="contactForm" @submit.prevent="onSubmitForm">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" v-model="contactForm.firstname" class="form-control" id="firstname" required>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" v-model="contactForm.lastname" class="form-control" id="lastname" required>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="example-select" v-model="contactForm.gender">
                        <option v-for="(item, index) in contactForm.genderItems" :key="index" :value="item">{{ item }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" v-model="contactForm.birthdate" class="form-control" id="birthdate" required>
                </div>
                <div class="col-md-4">
                    <label for="phone1" class="form-label">Main Phone</label>
                    <input type="phone" v-model="contactForm.phone1" class="form-control" id="phone1" required>
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
                    <button type="submit" class="btn btn-primary" @click="onSubmitForm" :disabled="loadingForm">
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

import axios from 'axios'

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
                firstname: '',
                lastname: '',
                phone1: '',
                phone2: '',
                fax: '',
                birthdate: '',
                gender: null,
                genderItems: ['M', 'F']
            },
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

        async onSubmitForm() {

            if (!this.isFormChanged) {
                this.formMessage = 'Form data didn`t change. No need to update.'
                this.formMessageClass = 'alert-warning'
                return
            }

            this.loadingForm = true

            try {

                const response = await axios.post('/profile/updateContactInfo', this.contactForm, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                console.log(response.data)

                this.formMessage = response.data.message
                this.formMessageClass = response.status === 200 ? 'alert-success' : 'alert-danger'

                if (response.status === 200) {
                    const { firstname, lastname } = this.contactForm
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

        async fillContactInfo() {
            this.loadingForm = true

            try {
                const response = await axios.get('/profile/getContactInfo', {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                const data = response.data

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
                this.loadingForm = false
            }
        }
    },

    filters: {

    },

    computed: {

    },

    mounted() {
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

}
</script>
