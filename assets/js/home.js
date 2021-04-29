import Vue from 'vue';
import Contact from '../components/contact/contactForm.vue';


/**
 * 
 * ***********************************************************************
 *      SERVICES AND SKILLS ANIMATIONS. CSS file is in animation.css
 * ***********************************************************************
 */

/**
 * @param mixed element
 * 
 * @return [type]
 */
function isInViewport(element) {
    const rect = element.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

const leftService = document.querySelectorAll('.service-left');
const rightService = document.querySelectorAll('.service-right');
const leftSkill = document.querySelectorAll('.skill-left');
const rightSkill = document.querySelectorAll('.skill-right');

/**
 * @param mixed elements
 * @param mixed animation
 * 
 * @return [type]
 */
function animate(elements, animation) {
    elements.forEach((element) => {
        document.addEventListener('scroll', function () {
            if (isInViewport(element)) {
                element.classList.add(animation);
            }
        });
    });
}

animate(leftService, 'animated-left');
animate(rightService, 'animated-right');
animate(leftSkill, 'animated-left');
animate(rightSkill, 'animated-right');

// Contact Form injected in index.html.twi template.
new Vue(
    {
        el: '#app',
        delimiters: [ '${', '}'],
        components: { 'contact-form': Contact },
        data: {
            message: 'hello world'
        }
    }
);


