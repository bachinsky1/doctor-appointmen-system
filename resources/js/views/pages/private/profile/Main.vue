<template>
    <Page>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <ContactInformation class="mb-4" />
            </div>
            <!-- ... -->
            <div>09</div>
        </div>
    </Page>
</template>

<script>

import { defineComponent, onBeforeMount, reactive, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import { toUrl } from "@/helpers/routing"
import UserService from "@/services/UserService"
import ContactInformation from "@/views/pages/private/profile/ContactInformation"
import Page from "@/views/layouts/Page"

export default defineComponent({
    components: {
        Page,
        ContactInformation,
    },
    setup() {
        const { user } = useAuthStore()

        const page = reactive({
            id: 'edit_user',
            title: trans('global.pages.users_edit'),
            filters: false,
            loading: true,
            actions: [
                {
                    id: 'submit',
                    name: trans('global.buttons.update'),
                    icon: "fa fa-save",
                    type: 'submit'
                }
            ]
        })

        const service = new UserService();

        onBeforeMount(() => {
            console.log('onBeforeMount')
        })

        function onAction(data) {
            console.log(data)
        }

        return {
            user
        }
    }
})
</script>