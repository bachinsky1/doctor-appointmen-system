import ModelService from "@/services/ModelService"
import axios from "axios"
import { useGlobalStateStore } from "@/stores/global"
export default class ConsultationService extends ModelService {

    private globalStateStore

    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
        this.globalStateStore = useGlobalStateStore()
    }

    public activate(appointmentId) {
        this.globalStateStore.loadingElements['consultation'] = true
        return this.get(`${this.url}/activate/${appointmentId}`).finally(() => {
            this.globalStateStore.loadingElements['consultation'] = false
        })
    }

    public close(data) {
        this.globalStateStore.loadingElements['consultation'] = true
        return this.post(`${this.url}/close`, data).finally(() => {
            this.globalStateStore.loadingElements['consultation'] = false
        })
    }

    public getPrevious(data) {
        this.globalStateStore.loadingElements['previousConsultations'] = true

        return this.post(`${this.url}/previous`, data).finally(() => {
            this.globalStateStore.loadingElements['previousConsultations'] = true
        })
    }
 
    
}
