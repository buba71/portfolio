import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';
import CreatePersistedState from 'vuex-persistedstate';
// Modules.
import Posts from './modules/posts.js';
import PostDetails from './modules/postDetails.js';
import AdminAuth from './modules/adminAuth.js';
import FlashMessage from './modules/flashMessage';

Vue.use(Vuex);
// Change to baseURL to "https://david-de-lima.tech/api/" on production env.
// Change to baseURL to "/api/" on production env.
Axios.defaults.baseURL = "/api/";


export default new Vuex.Store({
    modules: {
        fetchPosts: Posts,
        fetchPostDetails: PostDetails,
        adminAuth: AdminAuth,
        flashMessage: FlashMessage
    },
    plugins: [ CreatePersistedState({
        paths: ["adminAuth.isLogin"]
    }) ]
});