import ModelService from "@/services/ModelService"
import axios from "axios"
import { useGlobalStateStore } from "@/stores/global"

export default class ConsultationNoteService extends ModelService {
    private globalStateStore

    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
        this.globalStateStore = useGlobalStateStore()
    }

    public getConsultationNotes(consultationId) {
        this.globalStateStore.loadingElements['consultationNotes'] = true

        return this.get(`${this.url}/notes/consultation/${consultationId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['consultationNotes'] = false
            })
    }

    public storeConsultationNote(data) {
        this.globalStateStore.loadingElements['consultationNotes'] = true
        const consultationId = data.public_id

        return this.post(`${this.url}/notes/consultation/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['consultationNotes'] = true
            })
    }

    public patchConsultationNote(data) {
        this.globalStateStore.loadingElements['consultationNotes'] = true
        const consultationId = data.public_id
        
        return this.patch(`${this.url}/notes/consultation/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['consultationNotes'] = true
            })
    }

    public deleteConsultationNote(data) {
        this.globalStateStore.loadingElements['consultationNotes'] = true
        const consultationId = data.public_id
        const noteId = data.note_id

        return this.delete(`notes/consultation/${consultationId}/${noteId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['consultationNotes'] = true
            })
    }
}