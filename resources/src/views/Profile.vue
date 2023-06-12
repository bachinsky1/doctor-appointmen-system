<template>
    <h2>My Profile</h2>
    <div class="row">
        <div class="col">
            <div class="card mb-5">
                <div class="card-header">Contact Information</div>
                <div class="card-body">
                    <form class="row g-3" id="contactForm" ref="contactForm" @submit.prevent="onSubmitContactForm">
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
                            <input type="text" v-model="contactForm.gender" class="form-control" id="gender">
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
                            <input type="hidden" name="_token" :value="csrfToken">
                            <button type="submit" class="btn btn-primary" @click="onSubmitContactForm">Update</button>
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
                gender: '',
            },
            csrfToken: ''
        }
    },
    methods: {
        async onSubmitContactForm() {
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
            } catch (error) {
                console.error(error)
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
            console.error('CSRF meta tag not found')
        }
    }
}
</script>
