<template>
    <div class="relative">
        <input v-model="searchTerm" placeholder="Search..." @input="handleInput" type="search" class="w-full placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm" id="exampleSearch" />
        <ul ref="list" v-show="!hideList && filteredItems.length > 0" class="mt-1 absolute top-full left-0 w-full bg-white border border-gray-300 border-theme-500 rounded-b-md focus:outline-none focus:ring-theme-500 focus:border-theme-500 shadow-lg">
            <li v-for="item in filteredItems" :key="item.id" class="py-3 px-3 mr-6 cursor-pointer hover:bg-gray-100" @click="handleItemClick(item); hideList = true">{{ item.full_name }} - {{ item.establishment_name }}</li>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import SearchService from '@/services/SearchService'
import SearchInput from 'vue-search-input'

export default defineComponent({
    components: {
        SearchInput
    },

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
            // return this.items.filter(item => item.last_name.toLowerCase().includes(this.searchTerm.toLowerCase()))
        },
    },

    methods: {
        handleInput() {
            clearTimeout(this.searchTimeout)
            this.searchTimeout = setTimeout(async () => {
                const service = new SearchService(`symptom`)
                const result = await service.search(this.searchTerm)
                this.items = result.data

                this.hideList = false // Show list after getting search results
            }, 500)
        },

        handleItemClick(item) {
            // Handling the click event on a list item
            console.log(`Clicked element: "${item.id} - ${item.name}"`)
            this.searchTerm = ''
            this.hideList = true
            this.$router.push({
                name: 'appointment', params: {
                    id: item.id
                }
            })
        },

        handleClickOutside(event) {
            // Handling the click event outside the list
            if (this.$refs.list && !this.$refs.list.contains(event.target)) {
                this.searchTerm = ''
                this.hideList = true
            }
        },
    },

    mounted() {
        document.addEventListener('click', this.handleClickOutside)
    },

    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside)
    }
})

</script>