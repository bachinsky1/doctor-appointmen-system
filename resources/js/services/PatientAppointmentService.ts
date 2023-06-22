import BaseService from "@/services/BaseService"
import axios from "axios"

export default class PatientAppointmentService extends BaseService {

    constructor () {
        super()
        // this.url = 'api/medicalestablishment'
        this.url = 'api'
        this.setupAPI(axios.defaults.baseURL)
    }

    // public getMedicalestablishments() {
    //     return this.get(this.url)
    // }

    // public getHealthProfessionals(medestId) {
    //     return this.get(`${this.url}/{${medestId}}/healthprofessionals`)
    // }

    
}

