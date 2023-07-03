import { v4 as uuidv4 } from "uuid"
import moment from "moment"

export function createEventId() {
    return uuidv4()
}

export function convertCalendarDates(info) {
    const start = moment(
        info.view.activeStart,
        "ddd MMM DD YYYY HH:mm:ss [GMT]ZZ"
    ).format("YYYY-MM-DDTHH:mm:ssZ");

    const end = moment(
        info.view.activeEnd,
        "ddd MMM DD YYYY HH:mm:ss [GMT]ZZ"
    ).format("YYYY-MM-DDTHH:mm:ssZ")

    return { start, end }
}
