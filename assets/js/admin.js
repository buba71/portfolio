import Vue from 'vue';
import VueRouter from 'vue-router';
// Manage Dates
import Moment from 'moment';
import adminPanel  from '../Components/admin/index.vue';
import EditPost from '../Components/admin/editPost.vue';
import CreatePost from '../Components/admin/CreatePost';
import Store from '../store/store.js';

// Init locale for Moment.js
Moment.locale('fr');
// Format Date display
Vue.filter('formatDate', function (value) {
    if (value) {
        return Moment(String(value)).format('ll');
    }
});

Vue.use(VueRouter);

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

    }

];

const router = new VueRouter({routes});

let V = new Vue(
    {
        el: '#app',
        router,
        store: Store,
        data: {

        }

    }
);

