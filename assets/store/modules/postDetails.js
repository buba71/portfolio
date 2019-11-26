import Axios from "axios";


export default {
    state: {
        post: {
            title: '',
            content: '',
            comments: []
        }
    },
    getters: {
        getPost: function (state) {
            return state.post;
        },
    },
    actions:{
        fetchPostDetails: async function ( {commit}, post) {

            let response = await Axios.get(`posts/ ${post}`);
            let apiPost = response.data;

            commit('SET_POST', apiPost);
        },
        postComment: async function ( {commit}, comment) {
            let response = await Axios.post('comments', comment);
            let apiComment = response.data;

            commit("ADD_COMMENT", apiComment);
        }
    },
    mutations: {
        SET_POST: function (state, apiPost) {
            state.post.title = apiPost.title;
            state.post.content = apiPost.content;
            state.post.comments = apiPost.comments;
        },
        ADD_COMMENT: function (state, apiComment) {
            state.post.comments.unshift(apiComment);
        }
    }

}