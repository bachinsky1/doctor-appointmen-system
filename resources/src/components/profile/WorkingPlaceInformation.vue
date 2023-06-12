<template>
    <div class="card mb-5">
        <div class="card-header">Work places</div>
        <div class="card-body">
            <form class="row g-3" id="workPlaceForm" @submit.prevent="onSubmit">
                <div v-for="(workplace, index) in workplaces" :key="index">
                    <div class="mb-3">
                        <label for="position">Position</label>
                        <select v-model="workplace.position_id" class="form-select" id="position">
                            <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="speciality">Speciality</label>
                        <select v-model="workplace.speciality_id" class="form-select" id="speciality">
                            <option v-for="speciality in specialities" :key="speciality.id" :value="speciality.id">{{ speciality.name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="medicalestablishment">Medical establishment</label>
                        <select v-model="workplace.medicalestablishment_id" class="form-select" id="medicalestablishment">
                            <option v-for="medicalestablishment in medicalestablishments" :key="medicalestablishment.id" :value="medicalestablishment.id">{{ medicalestablishment.name }}</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger" @click="removeWorkplace(index)">Delete</button>
                    <hr>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-success mt-3">Update</button>
                    <button type="button" class="btn btn-primary mt-3" @click="addWorkplace">Add work place</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            workplaces: [],
            positions: [],
            specialities: [],
            medicalestablishments: []
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/profile/getWorkplace')
                .then(response => {
                    this.workplaces = response.data.workplaces;
                    this.positions = response.data.positions;
                    this.specialities = response.data.specialities;
                    this.medicalestablishments = response.data.medicalestablishments;
                })
                .catch(error => console.log(error));
        },
        addWorkplace() {
            this.workplaces.push({
                position_id: null,
                speciality_id: null,
                medicalestablishment_id: null
            });
        },
        removeWorkplace(index) {
            this.workplaces.splice(index, 1);
        },
        onSubmit() {
            axios.post('/profile/updateWorkplace', { workplaces: this.workplaces })
                .then(response => {
                    // handle success
                    console.log(response);
                })
                .catch(error => {
                    // handle error
                    console.log(error);
                });
        }
    }
}
</script>
