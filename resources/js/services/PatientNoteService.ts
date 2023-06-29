import ModelService from "@/services/ModelService"
import axios from "axios"
import { useGlobalStateStore } from "@/stores/global"

export default class PatientNoteService extends ModelService {
    private globalStateStore

    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
        this.globalStateStore = useGlobalStateStore()
    }

    public getPatientNotes(consultationId) {
        this.globalStateStore.loadingElements['patientNotes'] = true

        return this.get(`${this.url}/notes/patient/${consultationId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['patientNotes'] = false
            })
    }

    public storePatientNote(data) {
        this.globalStateStore.loadingElements['patientNotes'] = true
        const consultationId = data.public_id

        return this.post(`${this.url}/notes/patient/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['patientNotes'] = true
            })
    }

    public patchPatientNote(data) {
        this.globalStateStore.loadingElements['patientNotes'] = true
        const consultationId = data.public_id

        return this.patch(`${this.url}/notes/patient/${consultationId}`, data)
            .finally(() => {
                this.globalStateStore.loadingElements['patientNotes'] = true
            })
    }

    public deletePatientNote(data) {
        this.globalStateStore.loadingElements['patientNotes'] = true
        const consultationId = data.public_id
        const noteId = data.note_id

        return this.delete(`notes/patient/${consultationId}/${noteId}`)
            .finally(() => {
                this.globalStateStore.loadingElements['patientNotes'] = true
            })
    }
}