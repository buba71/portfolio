export default {

    state: {
        isLogin: false,
    },
    getters: {
        isLogin(state) {
            return state.isLogin;
        }
    },
    mutations: {
        AUTH_ADMIN: function (state, payload) {
            state.isLogin = payload;
            console.log('isLogin status', state.isLogin);

        }
    },
    actions: {
        toggleAdminStatus: function ({commit}, status) {
            commit('AUTH_ADMIN', status);
        }
    }
};