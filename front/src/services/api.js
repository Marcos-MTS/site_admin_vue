import axios from "axios";
import store from '../store'

const api = axios.create({
    headers : {
        'Content-Type' : 'application/json; multipart/form-data',
        'Accept' : 'application/json',
        Authorization: 'Bearer ' + store.state.token 
      },
    baseURL: "http://127.0.0.1:8000/api"
});

export default api;