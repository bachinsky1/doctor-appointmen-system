<template>
    <h2>My Profile</h2>
    <div class="row">
        <div class="col">
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
        </div>
        <div class="col">
            <h3>Address</h3>
        </div>
    </div>
</template>

<script lang="ts">

export default {
    name: 'Profile',
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
            },
            csrfToken: '',
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: ''
        }
    },
    methods: {
        async onSubmitContactForm() {
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
                if (response.ok) {
                    this.formMessage = 'Form submitted successfully!'
                    this.formMessageClass = 'alert-success'
                } else {
                    this.formMessage = 'Error submitting form'
                    this.formMessageClass = 'alert-danger'
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
        const csrfMeta = document.querySelector('meta[name="csrf-token"]')

        if (csrfMeta !== null) {
            this.csrfToken = csrfMeta.getAttribute('content') || ''
        } else {
            throw new Error('CSRF meta tag not found') 
        }

        this.fillContactInfo()
    }
}
</script>
