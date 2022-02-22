import axios from "axios";

const api = axios.create({
    headers : {
        'Content-Type' : 'application/json',
        'Accept' : 'application/json',
      },
    baseURL: "http://127.0.0.1:8000/api"
});

export default api;