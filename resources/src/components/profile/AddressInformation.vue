<template>
    <div class="card mb-5">
        <div class="card-header">Addresses</div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div v-for="(address, index) in addresses" :key="index">
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
                    <button type="submit" class="btn btn-success">Save / Update</button>
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
            addresses: [
                {
                    street: '',
                    house_number: '',
                    city: '',
                    state: '',
                    zip_code: '',
                    is_main_address: false
                }
            ]
        }
    },
    methods: {
        addAddress() {
            this.addresses.push({
                street: '',
                house_number: '',
                city: '',
                state: '',
                zip_code: '',
                is_main_address: false
            })
        },

        deleteAddress(index: number) {
            this.addresses.splice(index, 1)
        },

        submitForm() {
            
        }
    }
}

</script>
