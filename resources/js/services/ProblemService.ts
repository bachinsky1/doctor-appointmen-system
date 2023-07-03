import ModelService from "@/services/ModelService"
import axios from "axios"
import { useGlobalStateStore } from "@/stores/global"

export default class ProblemService extends ModelService {
    private globalStateStore

    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
        this.globalStateStore = useGlobalStateStore()
    }

    public get(consultationId) {
        this.globalStateStore.loadingElements['icd10diagnosis'] = true

        return this.get(`${this.url}/problems/${consultationId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['icd10diagnosis'] = false
            })
    }

    public store(data) {
        this.globalStateStore.loadingElements['icd10diagnosis'] = true
        const consultationId = data.public_id

        return this.post(`${this.url}/problems/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['icd10diagnosis'] = true
            })
    }

    public delete(data) {
        this.globalStateStore.loadingElements['icd10diagnosis'] = true
        const consultationId = data.public_id
        const noteId = data.note_id

        return this.delete(`problems/${consultationId}/${noteId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['icd10diagnosis'] = true
            })
    }
}