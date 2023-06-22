<template>
    <Search />
</template>
 

<script>

import { defineComponent, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import Page from "@/views/layouts/Page"
import Search from '@/views/components/Search.vue'

export default defineComponent({
    components: {
        Page,
        Search
    },

    data() {
        return {
            query: '',
            symptoms: [],
        }
    },

    methods: {

    }

})
</script>