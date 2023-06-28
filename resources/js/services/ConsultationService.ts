import ModelService from "@/services/ModelService"
import axios from "axios"

export default class ConsultationService extends ModelService {
    
    constructor () {
        super()
        this.url = '/api/consultation'
        this.setupAPI(axios.defaults.baseURL)
    }

    public activate(appointmentId) {
        return this.get(`${this.url}/activate/${appointmentId}`)
    }

   

}
