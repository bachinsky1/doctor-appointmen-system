<template>
    <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-2">
                    <input type="text" v-model="form.first_name" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                <div class="mt-2">
                    <input type="text" v-model="form.last_name" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                <div class="mt-2">
                    <select v-model="form.gender" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option v-for="(item, index) in form.genderItems" :key="index" :value="item">{{ item }}</option>
                    </select>
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Birthdate</label>
                <div class="mt-2">
                    <input type="text" v-model="form.birthdate" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Main phone</label>
                <div class="mt-2">
                    <input type="text" v-model="form.phone1" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Second phone</label>
                <div class="mt-2">
                    <input type="text" v-model="form.phone2" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Fax</label>
                <div class="mt-2">
                    <input type="text" v-model="form.fax" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <button @click="onSubmitForm" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
        </div>
    </div>
</template>

<script>
import { watch, onMounted, defineComponent, reactive, ref } from 'vue'
import ProfileService from "@/services/ProfileService"
export default {
    name: 'ContactInformation',
    components: {},
    props: {},

    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                phone1: '',
                phone2: '',
                fax: '',
                birthdate: null,
                gender: null,
                genderItems: ['M', 'F']
            },
        }
    },

    mounted() {
        console.log('mounted')
        this.fillForm()

    },

    setup: () => {
        return {}
    },

    methods: {
        onFormChange() {

        },


        async onSubmitForm() {
            const service = new ProfileService()
            service
                .updateContactInformation(this.form)
                .then((response) => {
                    const data = response.data
                    console.log(data)
                })
                .catch((error) => {
                    console.log(error)
                })

        },

        fillForm(params) {
            const service = new ProfileService()
            service
                .getContactInformation()
                .then((response) => {
                    const data = response.data

                    this.form.first_name = data.first_name
                    this.form.last_name = data.last_name
                    this.form.phone1 = data.phone1
                    this.form.phone2 = data.phone2
                    this.form.fax = data.fax
                    this.form.birthdate = data.birthdate
                    this.form.gender = data.gender
                })
                .catch((error) => {
                    console.log(error)
                })
        },
    },

    filters: {},

    computed: {},


    beforeDestroy() {

    },

}
</script>