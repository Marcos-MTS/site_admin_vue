import axios from "axios";
import store from '../store'

const api = axios.create({
    headers : {
        'Content-Type' : 'application/json; multipart/form-data',
        'Accept' : 'application/json',
        Authorization: 'Bearer ' + store.state.token 
      },
    baseURL: process.env.VUE_APP_API_URL +"/api"
});

console.log(store.state.token)

export default api;