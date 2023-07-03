<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Problems</h2>
        </div>
        <div class="border-t border-b border-gray-200 max-h-20vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <input type="text" v-model="searchTerm" @input="search" placeholder="Search..." class="border border-gray-300 rounded-md py-2 px-3 mb-3">
                <ul id="icd10Diagnosis">
                    <li v-for="result in items" :key="result.id" class="border border-gray-300 rounded-md py-2 px-3 mb-3">{{ result.title1 }}</li>
                </ul>
            </div>
        </div>
        <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
            <p class="text-gray-500">Footer</p>
        </div>
    </div>
</template>

<script>
 
import SearchService from '@/services/SearchService'

export default {
    name: 'Problems',
    data() {
        return {
            items: [],
            searchTerm: '',
            searchTimeout: null,
            hideList: true
        }
    },
    computed: {
        filteredItems() {
            if (!Array.isArray(this.items)) {
                return []
            }
            // console.log(this.items)
            return this.items
        },
    },

    methods: { 
        search() {
            clearTimeout(this.searchTimeout)
            this.searchTimeout = setTimeout(async () => {
                const service = new SearchService(`icd10`)
                const result = await service.search(this.searchTerm)
                // this.items = result.data

                console.log(result.data)

                this.hideList = false // Show list after getting search results
            }, 500)
        },

        handleItemClick(item) {
            // Handling the click event on a list item
            this.searchTerm = ''
            this.hideList = true
            console.log(item)
        },

        handleClickOutside(event) {
            // Handling the click event outside the list
            console.log(event)
        },

    },

    mounted() {
        document.addEventListener('click', this.handleClickOutside)
    },

    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside)
    }
}
</script>
