import ModelService from "@/services/ModelService"

export default class UserService extends ModelService {

    constructor () {
        super()
        this.url = '/profile'
    }

    public getContact() {
        return this.get(`/profile/contact`)
    }

    public updateContact(payload) {
        return this.post(`/profile/contact`, payload)
    }

    public getWorkingPlace() {
        return this.get(`/profile/workplace`)
    }

    public updateWorkingPlace(payload) {
        return this.post(`/profile/workplace`, payload)
    }

    public getAddress() {
        return this.get(`/profile/address`)
    }

    public updateAddress(payload) {
        return this.post(`/profile/address`, payload)
    }

}
