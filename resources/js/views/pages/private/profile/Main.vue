<template>
    <Page title="Profile">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <Contact class="mb-4" />
                <!-- ... -->
            </div>
            <div class="w-full">
                <WorkingPlace class="mb-4" />
                <!-- ... -->
            </div>
            <div class="w-full">
                <Address class="mb-4" />
                <!-- ... -->
            </div>
        </div>
    </Page>
</template>

<script>

import { defineComponent, onBeforeMount, reactive, ref } from "vue"
import { trans } from "@/helpers/i18n"
import { useAuthStore } from "@/stores/auth"
import { toUrl } from "@/helpers/routing"
import UserService from "@/services/UserService"
import Contact from "@/views/pages/private/profile/Contact"
import WorkingPlace from "@/views/pages/private/profile/WorkingPlace"
import Address from "@/views/pages/private/profile/Address"
import Page from "@/views/layouts/Page"

export default defineComponent({
    components: {
        Page,
        Contact,
        WorkingPlace,
        Address,
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