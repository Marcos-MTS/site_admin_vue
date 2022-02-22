
import {createStore} from 'vuex'

export default createStore({
    state: {
        user: {
            first_name: '',
            last_name: ''
        },
        token: localStorage.getItem('access_token') || null,
    },
    getters: {
        loggedIn(state) {
            return state.token !== null
        },
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        },
    },
    actions: {
        destroyToken(context) {

            if (context.getters.loggedIn) {
                localStorage.removeItem('access_token')
                context.commit('destroyToken')
            }
        },
        retrieveToken(context, credentials) {
            
            localStorage.setItem('access_token', credentials.access_token)
            context.commit('retrieveToken', credentials.access_token)
        },
    }
})