<template>
    <div class="relative">
        <input v-model="searchTerm" placeholder="Search..." @input="handleInput" type="search" class="w-full placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-theme-500 focus:border-theme-500 text-sm" id="exampleSearch" />
        <ul v-if="filteredItems.length > 0" class="mt-1 absolute top-full left-0 w-full border border-gray-300 rounded-b-md">
            <li v-for="item in filteredItems" :key="item.id">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script>

import { defineComponent, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import SearchService from '@/services/SearchService'
import SearchInput from 'vue-search-input'

export default {
    components: {
        SearchInput
    },

    data() {
        return {
            items: [],
            searchTerm: '',
            searchTimeout: null,
        }
    },
    computed: {
        filteredItems() {
            if (!Array.isArray(this.items)) {
                return []
            }

            return this.items.filter(item => item.name.toLowerCase().includes(this.searchTerm.toLowerCase()))
        },
    },
    methods: {

        handleInput() {
            clearTimeout(this.searchTimeout)
            this.searchTimeout = setTimeout(async () => {
                const service = new SearchService(`symptom`)
                const result = await service.search(this.searchTerm)
                this.items = result.data
                console.log(this.items)
            }, 500)
        },

    }
}
</script>
<style>
.header {
    position: relative;
}
</style>