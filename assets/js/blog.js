import Vue from 'vue';
import VueRouter from 'vue-router';
import Moment from 'moment';
import blogIndex from '../views/blog/index.vue';
import PostDetails from '../views/blog/postDetails.vue';
import NotFound from '../Components/notfound/notFound.vue';
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

Vue.config.productionTip = false;

const routes = [
    {
        path: '/',
        name: 'posts',
        component: blogIndex
        //children: [
            //{
                //path: '/:id/:slug',
                //name: 'post',
                //component: PostDetails
            //}
        // ]
    },
    {
        path: '/:id/:slug',
        name: 'post',
        component: PostDetails
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

    const router = new VueRouter({
        routes
    });

    new Vue(
        {
            el:'#app',
            store: Store,
            router,
        }
    );