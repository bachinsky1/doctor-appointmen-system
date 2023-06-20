import ModelService from "@/services/ModelService"
import moment from 'moment'

export default class CalendarService extends ModelService {

    constructor () {
        super()
        this.url = '/appointment'
    }

    public getAppointments() {
        return this.get(`/appointment`)
    }

    public destroyAppointment(public_id: string) {
        return this.delete(public_id)
    }

    public storeAppointment(payload) {
        // console.log(payload)
        const { id, extendedProps, title, start, end, allDay } = payload.event
        return this.post(`/appointment`, {
            id,
            public_id: extendedProps.public_id,
            type_id: extendedProps.type_id,
            title,
            start: moment(start).format('YYYY-MM-DD HH:mm:ss'),
            end: moment(end).format('YYYY-MM-DD HH:mm:ss'),
            allDay
        })
    }

}
