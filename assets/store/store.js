import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';

Vue.use(Vuex);


export default new Vuex.Store({
    state: {
        posts: [],
        pageData: {
            currentPage: 1,
            firstPage: '',
            lastPage: '',
            nextPage: '',
            previousPage: '',
            totalPage: '',
            template: ''

        }
    },
    getters: {

    },
    actions: {
        loadPosts: function ({commit}, page) {
            Axios.get(page)
                .then((response) => {

                    let apiPosts = response.data["hydra:member"];
                    let apiPageData = response.data["hydra:view"];

                    console.log(response.data);

                    // execute mutations
                    commit('SET_POSTS', apiPosts);
                    commit('SET_PAGE_DATA', apiPageData);
                });
        },
        loadPostsByTag: function ({commit}, tag) {
            Axios.get('api/posts?tags.name=' + tag + '&page=1')
                .then((response) => {

                    // Init current page on page 1 to pagination component
                    this.state.pageData.currentPage = 1;

                    // Set data api
                    let apiPosts = response.data["hydra:member"];
                    let apiPageData = response.data["hydra:view"];
                    console.log(response.data);

                    // Make mutations data posts and data page(pagination)
                    commit('SET_POSTS', apiPosts);
                    commit('SET_PAGE_DATA', apiPageData);
                })
        }
    },
    mutations: {
        SET_POSTS: function (state, apiPosts) {
            state.posts = apiPosts;
        },
        SET_PAGE_DATA: function (state, apiPageData) {

            if (apiPageData["hydra:last"]) {
                state.pageData.firstPage = apiPageData["hydra:first"];
                state.pageData.lastPage = apiPageData["hydra:last"];
                state.pageData.nextPage = apiPageData["hydra:next"];
                state.pageData.previousPage = apiPageData["hydra:previous"];
                state.pageData.totalPage =  parseInt((apiPageData["hydra:last"]).substr(-1, 1));
                state.pageData.template = apiPageData["@id"];
            } else {
                state.pageData.totalPage = 1;
            }




            console.log("pageData", state.pageData);
        }

    }



})