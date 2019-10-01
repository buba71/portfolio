import { shallowMount } from "@vue/test-utils";
import NotFound from '../../assets/components/notfound/notFound.vue';

describe('NotFound', () => {
    test('Message error is correct', () => {
        const wrapper = shallowMount(NotFound);
        expect(wrapper.text()).toBe('Une erreur est survenue...');
    })
});






