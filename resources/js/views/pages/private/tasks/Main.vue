<template>
    <Page>
        <div class="w-1/2 m-auto text-center pt-10">
            <h1 class="text-6xl mb-4 font-bold text-gray-600">Tasks</h1>
        </div>
    </Page>
</template>

<script>

import { defineComponent, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import Page from "@/views/layouts/Page.vue"

export default defineComponent({
    components: {
        Page,
    },
    setup() {
        const store = useAuthStore()
        const isAvatarModalShowing = ref(false);

        function reloadAvatar() {
            store.getCurrentUser();
        }
        return {
            isAvatarModalShowing,
            reloadAvatar,
            trans
        }
    }
})
</script>