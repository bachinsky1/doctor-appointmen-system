import ModelService from "@/services/ModelService"
import axios from "axios"
import { useGlobalStateStore } from "@/stores/global"

export default class MedicalNoteService extends ModelService {
    private globalStateStore

    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
        this.globalStateStore = useGlobalStateStore()
    }

    public getMedicalNotes(consultationId) {
        this.globalStateStore.loadingElements['medicalNotes'] = true

        return this.get(`${this.url}/notes/medical/${consultationId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['medicalNotes'] = false
            })
    }

    public storeMedicalNote(data) {
        this.globalStateStore.loadingElements['medicalNotes'] = true
        const consultationId = data.public_id

        return this.post(`${this.url}/notes/medical/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['medicalNotes'] = true
            })
    }

    public patchMedicalNote(data) {
        this.globalStateStore.loadingElements['medicalNotes'] = true
        const consultationId = data.public_id
        
        return this.patch(`${this.url}/notes/medical/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['medicalNotes'] = true
            })
    }

    public deleteMedicalNote(data) {
        this.globalStateStore.loadingElements['medicalNotes'] = true
        const consultationId = data.public_id
        const noteId = data.note_id

        return this.delete(`notes/medical/${consultationId}/${noteId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['medicalNotes'] = true
            })
    }
}