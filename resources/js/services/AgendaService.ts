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

    public getAgenda(id?: number) {
        const url = id ? `${this.url}/${id}` : this.url
        return this.get(url)
    }

    public destroyAppointment(public_id: string) {
        const appointmentUrl = `${this.url}/appointment/${public_id}`
        return this.delete(appointmentUrl)
    }

    public storeAppointment(payload) {
        
        const { id, extendedProps, title, start, end, allDay } = payload.event
        const appointmentStoreUrl = `${this.url}/appointment/store`

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
}
