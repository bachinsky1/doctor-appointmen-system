<template>
    <Page title="Profile">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <ContactInformation class="mb-4" />
                <!-- ... -->
            </div>
            <div class="w-full">
                <WorkingPlaceInformation class="mb-4" />
                <!-- ... -->
            </div>
            <div class="w-full">
                <AddressInformation class="mb-4" />
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
import ContactInformation from "@/views/pages/private/profile/ContactInformation"
import WorkingPlaceInformation from "@/views/pages/private/profile/WorkingPlaceInformation"
import AddressInformation from "@/views/pages/private/profile/AddressInformation"
import Page from "@/views/layouts/Page"

export default defineComponent({
    components: {
        Page,
        ContactInformation,
        WorkingPlaceInformation,
        AddressInformation,
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