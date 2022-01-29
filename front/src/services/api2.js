//import Vue from 'vue'
import axios from 'axios'

const client = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
    json: true
})

export default {
    async execute(method, resource, data) {
        // inject the accessToken for each request
     //   let accessToken = await Vue.prototype.$auth.getAccessToken()
        return client({
            method,
            url: resource,
            data,
         //   headers: {
         //       Authorization: `Bearer ${accessToken}`
          //  }
        }).then(req => {
            return req.data
        })
    },
    getPosts() {
        return this.execute('get', '/news')
    },
    getPost(id) {
        return this.execute('get', `/news/${id}`)
    },
    createPost(data) {
        return this.execute('post', '/news', data)
    },
    updatePost(id, data) {
        return this.execute('put', `/news/${id}`, data)
    },
    deletePost(id) {
        return this.execute('delete', `/news/${id}`)
    }
}