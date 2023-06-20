import ModelService from '@/services/ModelService'
import moment from 'moment'

export default class CalendarService extends ModelService {

    constructor () {
        super()
        this.url = '/appointment'
    }

    public getAppointments() {
        return this.get(`/appointment`)
    }

    public destroyAppointment(id: number) {
        return this.delete(id)
    }

    public storeAppointment(payload: any) {
        console.log(payload)
        const { id, title, start, end, allDay } = payload.event
        return this.post(`/appointment`, {
            internal_id: id,
            title,
            start: moment(start).format('YYYY-MM-DD HH:mm:ss'),
            end: moment(end).format('YYYY-MM-DD HH:mm:ss'),
            allDay
        })
    }
}
