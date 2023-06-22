<template>
    <div>
        <h1>List of appointments for (ID: {{ id }})</h1>
    </div>
</template>
 

<script>

import { defineComponent, ref } from "vue"
// import { trans } from "@/helpers/i18n"
// import { useAuthStore } from "@/stores/auth"
// import Page from "@/views/layouts/Page"

export default defineComponent({
    components: {
        // Page,
    },

    props: {
        id: {
            type: String,
            required: true
        },
    },

    methods: {

    }

})
</script>