import ModelService from "@/services/ModelService"

export default class UserService extends ModelService {

    constructor () {
        super()
        this.url = '/profile'
    }

    public getContactInformation() {
        return this.get(`/profile/contact`)
    }

    public updateContactInformation(payload) {
        return this.post(`/profile/contact`, payload)
    }

}
