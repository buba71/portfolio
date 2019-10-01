import "babel-polyfill";
import { shallowMount } from "@vue/test-utils";
import TagSearch from '../../assets/components/blog/tagSearch';
import axios from 'axios';
jest.mock('axios');

describe('TagSearch', () => {

    beforeEach(() => {
        axios.get.mockReset();
        axios.get.mockResolvedValue()
    });
    it('Should set Tags to API value on mounted component', async() => {
        // Given
        const response = {
            data: {"hydra:member": [{name: 'symfony'}, {name: 'docker'}] }
        };
        // When
        axios.get.mockResolvedValue(response);
        const wrapper = shallowMount(TagSearch);
        await wrapper.vm.$nextTick();
        // Then
        expect(axios.get).toBeCalledWith('api/tags');
        expect(wrapper.findAll('li')).toHaveLength(2);
    });



    it('Should return random tag css color', async() => {
        // Given
        const response = {
            data: {"hydra:member": [{name: 'symfony'}, {name: 'docker'}] }
        };

        const colors = ['red', 'turquoise', 'blue', 'chocolate', 'purple'];

        //When
        axios.get.mockResolvedValue(response);
        const wrapper = shallowMount(TagSearch);
        await wrapper.vm.$nextTick();

        // Then
        expect(colors).toContain(wrapper.vm.changeTagColor(1));
        expect(wrapper.vm.tags).toEqual(expect.arrayContaining([ { name: "symfony"}, { name: "docker"}]));
    })


});

