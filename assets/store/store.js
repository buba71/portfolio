import Vue from 'vue';
import Vuex from 'vuex';
import CreatePersistedState from 'vuex-persistedstate';
// Modules.
import Posts from './modules/posts.js';
import AdminAuth from './modules/adminAuth.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        fetchPosts: Posts,
        adminAuth: AdminAuth
    },
    plugins: [ CreatePersistedState({
        paths: ["adminAuth.isLogin"]
    }) ]
});