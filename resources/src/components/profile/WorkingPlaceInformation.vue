<template>
    <div class="card mb-4">
        <div class="card-header">Work places</div>
        <div class="card-body">
            <form class="row g-3" @submit.prevent="onSubmit">
                <div v-for="(workplace, index) in workplaces" :key="index">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Position</label>
                            <select class="form-select" id="position" v-model="workplace.position_id">
                                <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Medicalestablishment</label>
                            <select class="form-select" id="medical-establishment" v-model="workplace.medicalestablishment_id">
                                <option v-for="medicalestablishment in medicalestablishments" :key="medicalestablishment.id" :value="medicalestablishment.id">{{ medicalestablishment.name }}</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" @click="removeWorkplace(index)">Удалить</button>
                    <hr>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button type="button" class="btn btn-primary" @click="addWorkplace">Add new</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">

import axios from 'axios'

export default {
    data() {
        return {
            workplaces: [] as Workplace[],
            positions: [] as Position[],
            medicalestablishments: [] as Medicalestablishment[],
            userId: null
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/profile/workplace')
                .then(response => {
                    this.workplaces = response.data.workplaces;
                    this.positions = response.data.positions;
                    this.medicalestablishments = response.data.medicalestablishments;
                    this.userId = response.data.userId;
                })
                .catch(error => console.log(error));
        },
        addWorkplace() {
            
            this.workplaces.push({
                user_id: this.userId,
                position_id: undefined,
                medicalestablishment_id: undefined
            });
        },

        removeWorkplace(index: number) {
            this.workplaces.splice(index, 1);
        },

        onSubmit() {
            axios.post('/profile/workplace', { workplaces: this.workplaces })
                .then(response => console.log(response))
                .catch(error => console.log(error));
        }
    }
}
</script>
