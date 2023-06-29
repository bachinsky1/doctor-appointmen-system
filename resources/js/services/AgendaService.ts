import ModelService from "@/services/ModelService"
import moment from 'moment'
import axios from "axios"

export default class AgendaService extends ModelService { 

    constructor () {
        super()
        this.url = '/api/agenda'
        this.setupAPI(axios.defaults.baseURL)
    }

    public getAppointmentTypes() {
        return this.get(`${this.url}/appointments/types`)
    }

    public getAgenda(payload: any) {
        
        if (Object.keys(payload).length < 2) return []

        const url = this.url
        // console.log(payload)

        const data = {
            start: payload.start,
            end: payload.end
        }

        if (!!payload.id) {
            data.id = payload.id
        }

        return this.post(url, data)
    }

    public destroyAppointment(public_id: string) {
        const url = `appointments/${public_id}`
        return this.delete(url)
    }

    public approveAppointment(public_id: string) {
        const url = `${ this.url }/appointments/approve`
        return this.patch(url, {public_id})
    }

    public storeAppointment(payload) {
        
        const { id, extendedProps, title, start, end, allDay } = payload.event
        const url = `${this.url}/appointments/store`

        return this.post(url, {
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

    public changeAppointment(payload) {

        const { extendedProps, start, end, allDay } = payload
        const url = `${this.url}/appointments/change`

        return this.post(url, {
            public_id: extendedProps?.public_id,
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
