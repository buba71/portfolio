import Axios from "axios";

export default {
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
        },
        hasSearchTag: false,
        pickedTag: '',
        successMsg: ''
    },
    getters: {
        // Return posts list.
        posts(state) {
            return state.posts;
        },
        // Return data of page for pagination.
        pageData(state) {
            return state.pageData;
        },
        // Return a boolean : click on any tag-> true, if not false.
        hasSearchTag(state) {
            return state.hasSearchTag;
        },
        // Return the Tag searched.
        pickedTag: function (state) {
            return state.pickedTag;
        },
        // Return the message to display in any action (editPost, createPost).
        successMsg: function (state) {
            return state.successMsg;
        }

    },
    actions: {
        loadPosts: function ({commit}, url) {
            Axios.get(url)
                .then((response) => {

                    let apiPosts = response.data["hydra:member"];
                    // if number of pages > 1, has response.Data["hydra:view']
                    if (response.data["hydra:view"]) {
                        let apiPageData = response.data["hydra:view"];
                        commit('SET_PAGE_DATA', apiPageData);
                    } else {
                        let apiPageData = [];
                        commit('SET_PAGE_DATA', apiPageData);
                    }

                    // execute mutations
                    commit('SET_POSTS', apiPosts);
                })
                .catch((error) => {
                    console.log('error', error);
                });
        },
        loadPostsByTag: function ({commit}, tag) {
            Axios.get(`api/posts?tags.name=${tag}&page=1`)
                .then((response) => {

                    // Init current page on page 1 to pagination component
                    this.getters.pageData.currentPage = 1;

                    // Set data api
                    let apiPosts = response.data["hydra:member"];
                    let apiPageData = response.data["hydra:view"];

                    // Make mutations data posts and data page(pagination)
                    commit('SET_POSTS', apiPosts);
                    commit('SET_PAGE_DATA', apiPageData);
                    // On selection tag
                    commit('ON_SEARCH_TAG');
                    commit('GET_PICKED_TAG', tag);
                })
                .catch((error) => {
                    console.log(error.response.data);
                })
        },
        displayMsg: function ({commit}, payload) {
            commit('SET_SUCCESS_MSG', payload);
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

        },
        ON_SEARCH_TAG: function (state) {
            state.hasSearchTag = true;
        },
        CLOSE_SEARCH_TAG: function (state) {
            state.hasSearchTag = false;
        },
        GET_PICKED_TAG: function (state, tag) {
            state.pickedTag = tag;
        },
        SET_SUCCESS_MSG: function (state, msg) {
            state.successMsg = msg;
        }


    }
};
