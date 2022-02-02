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
    },



    get2(controller, id = "") {
        return this.execute('get', '/' + controller + '/' + id)
    },



    get3() {



        client.get("/categories")
            .then((res) => {
                this.$refs.Message.close(false);
                if (res.status === 200) {
                    this.formData = res.data;
                } else {
                    console.log(res.statusText);
                    this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
}