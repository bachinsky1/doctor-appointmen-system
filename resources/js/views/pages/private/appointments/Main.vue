<template>
    <Page>
        <div class="w-1/2 m-auto text-center pt-10">
            <h1 class="text-6xl mb-4 font-bold text-gray-600">Appointments</h1>
        </div>
    </Page>
</template>

<script>

import { defineComponent, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import Page from "@/views/layouts/Page"

export default defineComponent({
    components: {
        Page,
    },
    setup() {
        return {
            trans
        }
    }
})
</script>