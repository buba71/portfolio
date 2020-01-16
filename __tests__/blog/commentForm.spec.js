import { shallowMount, createLocalVue } from "@vue/test-utils";
import VueRouter from "vue-router";
import Vuex from "vuex";
import CommentForm from "../../assets/components/blog/commentForm.vue";

describe('Adding a comment to any Post', () => {

    // Init a locale Vue instance for tests.
    const localVue = createLocalVue();
    localVue.use(VueRouter);
    localVue.use(Vuex);

    const router = new VueRouter();
    const store = new Vuex.Store({});
    // Mock store actions (postComment in this use case).
    store.dispatch = jest.fn();

    const wrapper = shallowMount(CommentForm, {
        localVue,
        router,
        store
    });

    it('Should set input comment form ', () => {

        const authorInput = wrapper.find('input');
        const contentTextarea = wrapper.find('textarea');

        authorInput.setValue('David');
        contentTextarea.setValue('Un commentaire');

        expect(wrapper.vm.comment.author).toEqual('David');
        expect(wrapper.vm.comment.content).toEqual('Un commentaire');
    });

    it('Should submit the comment', async() => {

        const form =  wrapper.find('form');
        form.trigger('submit.prevent');

        expect(store.dispatch).toBeCalledTimes(1);
    });
});
