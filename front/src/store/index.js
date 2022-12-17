
import { createStore } from 'vuex'

export default createStore({
    state: {
        user: {
            name: localStorage.getItem('user_name') || null,
            id: localStorage.getItem('user_id') || null,
            level: localStorage.getItem('user_level') || null,
            image: localStorage.getItem('user_image') || null
        },
        token: localStorage.getItem('access_token') || null,
    },
    getters: {
        loggedIn(state) {
            return state.token !== null
        },
    },
    mutations: {
        retrieveUser(state, credentials) {
            credentials.user_name ? state.user.name = credentials.user_name : null;
            credentials.user_id ? state.user.id = credentials.user_id : null;
            credentials.user_level ? state.user.level = credentials.user_level : null;
            credentials.user_image ? state.user.image = credentials.user_image : null;
            credentials.access_token ? state.token = credentials.access_token : null;
        },

        logout(state) {
            state.token = null;
            state.user.name = null;
            state.user.id = null;
            state.user.level = null;
            state.user.image = null;
        },
    },
    actions: {
        logout(context) {
            if (context.getters.loggedIn) {
                localStorage.removeItem('access_token')
                localStorage.removeItem('user_name')
                localStorage.removeItem('user_id')
                localStorage.removeItem('user_level')
                localStorage.removeItem('user_image')
                context.commit('logout')
            }
        },
        retrieveUser(context, credentials) {

            credentials.access_token ? localStorage.setItem('access_token', credentials.access_token) : null;
            credentials.user_id ? localStorage.setItem('user_id', credentials.user_id) : null;
            credentials.user_name ? localStorage.setItem('user_name', credentials.user_name) : null;
            credentials.user_level ? localStorage.setItem('user_level', credentials.user_level) : null;
            credentials.user_image ? localStorage.setItem('user_image', credentials.user_image) : null;

            context.commit('retrieveUser', credentials)
        },

    }
})