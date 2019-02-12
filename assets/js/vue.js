
import Vue from 'vue';
import VueScrollTo from 'vue-scrollto';

Vue.use(
    VueScrollTo,
    {
        container: "body",
        duration: 1500,
        easing: "ease-in",
        offset: -80,
        force: true,
        cancelable: true,
        onStart: false,
        onDone: false,
        onCancel: false,
        x: false,
        y: true
    }
);

new Vue(
    {
        el: '#app',
        delimiters: [ '${', '}'],
        data: {
            message: 'hello world!!'
        }
    }
);