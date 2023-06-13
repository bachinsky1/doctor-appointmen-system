declare module "*.vue" {
    import { defineComponent } from "vue"
    const Component: ReturnType<typeof defineComponent>
    export default Component
}

declare var axios: any
declare module 'bootstrap'
declare module '@vuelidate/core'

interface Address {
    street: string
    house_number: string
    city: string
    state: string
    zip_code: string
    is_main_address: boolean
}

interface Workplace {
    user_id: number | null
    position_id: number | undefined
    medicalestablishment_id: number | undefined
}

interface Position {
    id: number | undefined
    name: string | undefined
}

interface Medicalestablishment {
    id: number | undefined
    name: string | undefined
}


