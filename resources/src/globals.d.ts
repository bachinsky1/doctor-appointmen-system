declare module "*.vue" {
    import { defineComponent } from "vue"
    const Component: ReturnType<typeof defineComponent>
    export default Component
}

declare var axios: any
declare module 'bootstrap'
