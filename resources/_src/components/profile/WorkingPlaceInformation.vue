<template>
    <div class="card mb-4">
        <div class="card-header">Work places</div>
        <div class="card-body">
            <div v-if="formMessage" :class="['alert', formMessageClass, 'alert-dismissible', 'fade', 'show']">
                {{ formMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="formMessage = ''"></button>
            </div>
            <form class="row g-3" id="workplaceForm" ref="workplaceForm" @submit.prevent="onSubmitForm">
                <div v-for="(workplace, index) in workplaces" :key="index">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Position</label>
                            <select class="form-select" id="position" v-model="workplace.position_id" required>
                                <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Medicalestablishment</label>
                            <select class="form-select" id="medical-establishment" v-model="workplace.medicalestablishment_id" required>
                                <option v-for="medicalestablishment in medicalestablishments" :key="medicalestablishment.id" :value="medicalestablishment.id">{{ medicalestablishment.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-danger" @click="deleteWorkplace(index)">Delete</button>
                    </div>
                    <hr>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" @click="addWorkplace">Add workplace</button>
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

import axios from 'axios'

export default {
    name: 'WorkplacesInformation',

    data() {
        return {
            workplaces: [] as Workplace[],
            positions: [] as Position[],
            medicalestablishments: [] as Medicalestablishment[],
            userId: null,
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

        async fillForm() {

            try {
                const response = await axios.get('/profile/workplace')

                this.workplaces = response.data.workplaces
                this.positions = response.data.positions
                this.medicalestablishments = response.data.medicalestablishments
                this.userId = response.data.userId

            } catch (error) {
                console.log(error)
            } finally {
                this.loadingForm = false
            }
        },

        addWorkplace() {

            this.workplaces.push({
                user_id: this.userId,
                position_id: undefined,
                medicalestablishment_id: undefined
            })

            this.$nextTick(() => {
                const formElements = document.querySelectorAll('#workplaceForm')

                formElements.forEach(element => {
                    element.addEventListener('change', this.onFormChange)
                })

                this.onFormChange
            })

        },

        deleteWorkplace(index: number) {
            this.workplaces.splice(index, 1)

            const formElements = document.querySelectorAll('#workplaceForm')

            formElements.forEach(element => {
                element.removeEventListener('change', this.onFormChange)
            })

            this.$nextTick(() => {
                formElements.forEach((element, index) => {
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

            try {
                const response = await axios.post('/profile/workplace', { workplaces: this.workplaces })
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
    },

    mounted() {

        const formElements = document.querySelectorAll('#workplaceForm')

        formElements.forEach((element) => {
            element.addEventListener('change', this.onFormChange)
        })

        this.fillForm()
    },

    beforeDestroy() {
        const formElements = document.querySelectorAll('#workplaceForm')

        formElements.forEach(element => {
            element.removeEventListener('change', this.onFormChange)
        })
    },
}
</script>
