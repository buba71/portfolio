import Vue from 'vue';
import VueRouter from 'vue-router';
import blogIndex from '../Components/blog/index.vue';
import PostDetails from '../Components/blog/postDetails.vue';
import Store from '../store/store.js';

Vue.use(VueRouter);
Vue.config.productionTip = false;

const routes = [
    {
        path: '/',
        name: 'posts',
        component: blogIndex
    },
    {
        path: '/:id/:slug',
        name: 'post',
        component: PostDetails
    }
    ];

const router = new VueRouter({routes});

let V = new Vue(
    {
        el:'#app',
        store: Store,
        router,
        data: {

        }
    }
)