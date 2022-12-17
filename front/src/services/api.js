import axios from "axios";
import store from '../store'

const api = axios.create({
    headers : {
        'Content-Type' : 'application/json; multipart/form-data',
        'Accept' : 'application/json'
      },
    baseURL: process.env.VUE_APP_API_URL +"/api"
});
 
api.interceptors.request.use(
  (config) => {
    const token = store.state.token;
    if (token) {
     config.headers["Authorization"] = 'Bearer ' + token; 
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);
export default api;