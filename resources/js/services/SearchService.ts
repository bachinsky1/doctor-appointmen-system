import BaseService from "@/services/BaseService";
import axios from "axios";

export default class SearchService extends BaseService {

    constructor(entity) {
        super();
        this.url = '/api/' + entity;
        this.setupAPI(axios.defaults.baseURL);
    }

    public begin(phrase, page, perPage) {
        return this.get(this.url + `/?search=${phrase}&per_page=${perPage}&page=${page}`)
    }

    public search(phrase) {
        if (phrase.trim().length === 0) return false
        return this.get(`${this.url}/?search=${phrase}`)
    } 

}

