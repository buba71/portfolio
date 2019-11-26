export default {
    state: {
        successMsg: null
    },
    getters: {
        // Return the message to display in any action (editPost, createPost).
        successMsg: function (state) {
            return state.successMsg;
        }
    },
    actions: {
        displayMsg: function ({commit}, payload) {
            commit('SET_SUCCESS_MSG', payload);
        }
    },
    mutations: {
        SET_SUCCESS_MSG: function (state, msg) {
            state.successMsg = msg;
        }

    }
}