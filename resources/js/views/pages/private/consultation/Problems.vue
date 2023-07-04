<template>
    <div class="relative rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4 flex justify-between items-center">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                <button v-if="!showSearch" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-heartbeat"></i>
                </button>
                <button v-if="showSearch" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2" @click="showSearch = false;">
                    <i class="fas fa-arrow-left"></i>
                </button> Problems
            </h2>
        </div>
        <div v-if="!showSearch" class="max-h-30vh border-t border-b overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <ul id="icd10diagnosis">
                    <li v-for="result in items" :key="result.id" class="px-3 py-2 border-b border-gray-300">
                        {{ result.code1 }}: {{ result.title1 }}
                        <button class="float-right text-red-500 hover:text-red-700 focus:outline-none" @click="removeItem(result)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="showSearch" class="max-h-30vh overflow-auto p-3">
            <div class="flex items-center mb-3">
                <input type="text" v-model="searchTerm" @input="search" placeholder="Search diagnosis in ICD-10..." class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <ul id="icd10Diagnosis" v-show="!hideList" class="absolute top-100 right-0 z-50 w-full bg-white border border-gray-300 rounded-b-lg overflow-auto shadow-lg mb-3">
                <li v-for="result in searchItems" :key="result.id" class="px-3 py-2 cursor-pointer border-b border-gray-300" @click="handleItemClick(result)">
                    {{ result.code1 }}: {{ result.title1 }}
                </li>
            </ul>
        </div>
        <div v-if="!showSearch" class="bg-white rounded-b-lg p-4 flex justify-center items-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" @click="showSearch = true">
                <i class="fas fa-plus-circle"></i> Add new problem </button>
        </div>
        <BlockAlert :show="show" :type="type" :message="message" :description="description" @close="show = false" ref="alert" />
    </div>
</template>

<script>

import { getResponseError } from "@/helpers/api"
import SearchService from '@/services/SearchService'
import ProblemService from '@/services/ProblemService'
import { useConsultationStore } from '@/stores'
import BlockAlert from '@/views/components/BlockAlert.vue'

export default {
    name: 'Problems',

    components: {
        BlockAlert
    },

    data() {
        return {
            items: [],
            searchItems: [],
            searchTerm: '',
            searchTimeout: null,
            hideList: true,
            showSearch: false,
            show: false,
            type: '',
            message: '',
            description: ''
        }
    },

    async mounted() {
        try {
            setTimeout(async () => {
                const consultation = this.consultationStore.currentConsultation
                const response = await this.problemService.getProblems(consultation.public_id)
                this.items = response.data
                console.log(this.items, 1)
            })
        } catch (error) {
            console.error(error)
        }
    },

    methods: {
        showSuccess(message, description) {
            const alert = {
                type: 'success',
                message: message || 'Success!',
                description: description,
                show: true
            }

            this.$refs.alert.addAlert(alert)
        },
        showError(message, description) {
            const alert = {
                type: 'error',
                message: message || 'Error!',
                description: description,
                show: true
            }

            this.$refs.alert.addAlert(alert)
        },
        search() {
            clearTimeout(this.searchTimeout)
            this.searchTimeout = setTimeout(async () => {
                const service = new SearchService(`icd10`)
                const result = await service.search(this.searchTerm)
                this.searchItems = result.data
                this.hideList = false
            }, 500)
        },

        async handleItemClick(item) {
            this.searchTerm = ''
            this.hideList = true
            this.showSearch = false

            try {
                const data = {
                    public_id: this.consultationStore.currentConsultation.public_id,
                    problem: item
                }
                const response = await this.problemService.storeProblem(data)
                const result = response.data
                if (result) {
                    this.items.push(result)
                    this.showSuccess('Success!', 'Note saved successfully!')
                }
            } catch (error) {
                const { message, description } = getResponseError(error)
                this.showError(message, description)
            }
        },

        async removeItem(item) {
            if (confirm('Are you sure you want to delete this record?')) {
                const index = this.items.indexOf(item)
                console.log(this.items[index])
                const data = {
                    public_id: this.consultationStore.currentConsultation.public_id,
                    problem_id: this.items[index].id
                }

                try {
                    const result = await this.problemService.deleteProblem(data)
                    if (result.data) {
                        const index = this.items.indexOf(item)
                        if (index > -1) {
                            this.items.splice(index, 1)
                        }
                        this.showSuccess('Success!', 'Record deleted successfully!')
                    }
                } catch (error) {
                    const { message, description } = getResponseError(error)
                    this.showError(message, description)
                }

            } 
        }
    },

    setup() {

        const consultationStore = useConsultationStore()
        const problemService = new ProblemService()

        return {
            consultationStore,
            problemService
        }
    }
}
</script>