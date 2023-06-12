declare module "*.vue" {
    import { defineComponent } from "vue"
    const Component: ReturnType<typeof defineComponent>
    export default Component
}

declare var axios: any
declare module 'bootstrap'

interface Address {
    street: string
    house_number: string
    city: string
    state: string
    zip_code: string
    is_main_address: boolean
}
