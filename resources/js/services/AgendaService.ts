import ModelService from "@/services/ModelService"
import moment from 'moment'
import axios from "axios"

export default class AgendaService extends ModelService {
    private appointmentsUrl = `${this.url}/appointments`;

    constructor () {
        super()
        this.url = '/api/agenda'
        this.setupAPI(axios.defaults.baseURL)
    }

    public getAppointments() {
        return this.get(this.appointmentsUrl)
    }

    public getAppointmentTypes() {
        return this.get(`${this.url}/appointments/types`)
    }

    public getAgenda(payload: any) {
        const url = this.url
        console.log(payload)
        return this.post(url, {
            start: payload.start,
            end: payload.end
        })
    }

    public destroyAppointment(public_id: string) {
        const destroyAppointmentUrl = `appointments/${public_id}`
        return this.delete(destroyAppointmentUrl)
    }

    public approveAppointment(public_id: string) {
        const approveAppointmentUrl = `${ this.url }/appointments/approve`
        return this.patch(approveAppointmentUrl, {public_id})
    }

    public storeAppointment(payload) {
        
        const { id, extendedProps, title, start, end, allDay } = payload.event
        const appointmentStoreUrl = `${this.url}/appointments/store`

        return this.post(appointmentStoreUrl, {
            id,
            public_id: extendedProps?.public_id,
            type_id: extendedProps?.type_id,
            entity_id: extendedProps?.entity_id,
            title,
            start: moment(start).format('YYYY-MM-DD HH:mm:ss'),
            end: moment(end).format('YYYY-MM-DD HH:mm:ss'),
            allDay
        })
    }

    public searchPatient(phrase) {
        if (phrase.trim().length === 0) return false
        return this.get(`${this.url}/search/patient?search=${phrase}`)
    }
}
