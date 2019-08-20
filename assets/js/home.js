import Vue from 'vue';
import $ from 'jquery';
import VueRouter from 'vue-router';
import HomeIndex from '../views/home/home.vue';
import NotFound from '../Components/notfound/notFound.vue';
import VueScrollTo from 'vue-scrollto';
import CheckView from 'vue-check-view';

Vue.use(VueRouter);

Vue.use(
    VueScrollTo,
    {
        container: "body",
        duration: 1500,
        easing: "ease-in",
        offset: -80,
        force: true,
        cancelable: false,
        onStart: false,
        onDone: false ,
        onCancel: false,
        x: false,
        y: true
    }
);

Vue.use(CheckView);

Vue.config.productionTip = false;

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeIndex
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

    const router = new VueRouter({routes});


    new Vue(
        {
            el: '#app',
            delimiters: [ '${', '}'],
            router,
            data: {
                preloader: true
            },

            mounted: function () {
                this.preloading();
            },
            methods: {
                // close navBar onclick in mobile view
                close() {
                    let closeMenu = $('#navbarNav');
                    closeMenu.removeClass('show');
                },
                preloading() {
                    let v = this;
                    setTimeout(function () {
                        v.preloader = false;
                    },3000)
                }
            }
        }
    );