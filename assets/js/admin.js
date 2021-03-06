import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

// Manage Dates
import Moment from 'moment';

import adminPanel  from '../views/admin/index.vue';
import EditPost from '../views/admin/editPost.vue';
import CreatePost from '../views/admin/createPost.vue';
import Login from '../components/security/login.vue';
import NotFound from '../Components/notfound/notFound.vue';
import Store from '../store/store.js';

// Import the component FlashMessage. "default" fixe the component import issue.
const flashMessage = require('../components/blog/flashMessage.vue').default;

// Init locale for Moment.js
Moment.locale('fr');
// Format Date display
Vue.filter('formatDate', function (value) {
    if (value) {
        return Moment(String(value)).format('ll');
    }
});

Vue.use(VueRouter);

Vue.config.productionTip = false;

Axios.defaults.withCredentials = true;

// Admin routes
const routes = [
    {
        path: '/',
        name: 'index',
        component: adminPanel
    },
    {
        path: '/edit/:id',
        name: 'postEdit',
        component: EditPost
    },
    {
        path: '/create',
        name: 'postCreate',
        component: CreatePost

    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/404',
        component: NotFound
    },
    {
        path: '*',
        redirect: '/404'
    },
    ];

    // Initiate router.
    const router = new VueRouter({routes});

    // Intercept authentications errors on API requests.
    Axios.interceptors.response.use(response => {
        return response;
    }, (error) => {
        if (error.response.status === 403) {
            // If token expired or not present, Toggle the login state.
            Store.commit('AUTH_ADMIN', error.response.data.isLogin);
            router.push('/login');
            return Promise.reject(error);
        }
        return Promise.reject(error);

    });

    // Guard auth
    router.beforeEach((to, from, next) => {
        if (Store.getters.isLogin === true ) {   // Access to the Store.
            next();
        } else if (to.name === 'login') {
            next();
        } else {
            next('/login');
        }
    });




    new Vue(
        {
            el: '#app',
            delimiters: [ '${', '}'],
            components: { flashMessage },
            router,
            store: Store,
            data: {

            }
        }
    );

