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

<script>

export default {
    data() {
        return {

        }
    },

    methods: {
        onFormChange() {

        },

        async fillForm() {


        },

        addWorkplace() {



        },

        deleteWorkplace(index: number) {


            this.onFormChange()
        },

        async onSubmitForm() {


        },
    },

    mounted() {

    },

    beforeDestroy() {

    },
}
</script>