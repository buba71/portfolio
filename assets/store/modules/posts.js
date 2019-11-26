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
        pickedTag: ''
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
    },
    actions: {
        loadPosts: async function ({commit}, url) {

            let response = await Axios.get(url);

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
        },
        createPost: async function ( context , post) {
            await Axios.post(`posts`, { title: post.title, content: post.content, tags: post.tags});
            // commit("ADD_POST", post);
        },
        updatePost: async function ( context , post) {
            await Axios.put(`posts/${post.id}`, { title: post.title, content: post.content, tags: post.tags });
        },
        removePost: async function ( {commit}, postId) {
            // Delete Post from bdd.
            await Axios.delete(`posts/${postId}`);
            // Then update array Posts.
            commit("DELETE_POST", postId);

        },
        loadPostsByTag: function ({commit}, tag) {
            Axios.get(`posts?tags.name=${tag}&page=1`)
                .then((response) => {

                    // Init current page on page 1 to pagination component.
                    this.getters.pageData.currentPage = 1;

                    // Set data api.
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

    },
    mutations: {
        SET_POSTS: function (state, apiPosts) {
            state.posts = apiPosts;
        },
        ADD_POST: function (state, post) {
            state.post.push(post);
        },

        DELETE_POST: function (state, postId) {
            // Delete Post from array Posts.
            state.posts = state.posts.filter((item) => {
                return item.id !== postId;
            });
        },
        SET_PAGE_DATA: function (state, apiPageData) {
            // If has many pages.
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

    }
};
