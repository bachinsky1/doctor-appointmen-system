<template>
    <div class="relative rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Problems</h2>
        </div>
        <div class="max-h-30vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <input type="text" v-model="searchTerm" @input="search" placeholder="Search..." class="border border-gray-300 rounded-md py-2 px-3 mb-3 ">
                <ul id="icd10Diagnosis" v-show="!hideList" 
                class="absolute top-100 right-0 z-50 w-full bg-white border border-gray-300 rounded-b-lg overflow-auto shadow-lg mb-3 mt-12">
                    <li v-for="result in searchItems" :key="result.id" 
                        class="px-3 py-2 cursor-pointer hover:bg-gray-200 border-b border-gray-300" 
                        @click="handleItemClick(result)">
                        {{ result.code1 }}: {{ result.title1 }}
                    </li>
                </ul>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1">
                <ul>
                    <li v-for="result in items" :key="result.id" 
                        class="px-3 py-2 cursor-pointer hover:bg-gray-200 border-b border-gray-300" 
                        @click="handleItemClick(result)">
                        {{ result.code1 }}: {{ result.title1 }}
                    </li>

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
            searchItems: [],
            searchTerm: '',
            searchTimeout: null,
            hideList: true
        }
    },
    computed: {

    },

    methods: { 
        search() {
            clearTimeout(this.searchTimeout)
            this.searchTimeout = setTimeout(async () => {
                const service = new SearchService(`icd10`)
                const result = await service.search(this.searchTerm)
                this.searchItems = result.data

                // console.log(result.data)

                this.hideList = false 
            }, 500)
        },

        handleItemClick(item) { 
            this.searchTerm = ''
            this.hideList = true
            this.items.push(item)
            console.log(item)
        },

        handleClickOutside(event) { 
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
