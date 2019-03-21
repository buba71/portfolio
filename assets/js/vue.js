import Vue from 'vue';
import VueScrollTo from 'vue-scrollto';
import CheckView from 'vue-check-view';
import language from '../components/skills/language';
import framework from '../components/skills/framework';
import tool from '../components/skills/tool';
import scrollButton from '../components/navigation/scrollButton';
import ContactForm from '../components/contact/contactForm';

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


let app = new Vue(
            {
                el: '#app',
                delimiters: [ '${', '}'],
                components: { language, framework, tool, scrollButton, ContactForm },
                data: {
                    service: false,
                    skill: false,
                    preloader: true,
                },
                methods: {
                    viewServiceHandler(e) {
                        if (e.percentInView === 'enter') {
                            this.service = true;
                        }
                    },
                    viewSkillsHandler(e) {
                        if (e.type === 'enter') {
                            this.skill = true;
                        }
                    },
                    preloading() {
                        let v = this;
                        setTimeout(function () {
                            v.preloader = false;
                        },3000)
                    },
                    // close navBar onclick in mobile view
                    close() {
                        let closeMenu = $('#navbarNav');
                        closeMenu.removeClass('show');
                    }
                },
                mounted: function () {
                    this.preloading();
                }

            }
        );