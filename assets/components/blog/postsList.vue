<template>
    <div>
        <!-- Pass props at default slot -->
        <slot v-bind:posts="posts"></slot>
        <Pagination v-bind:pageData = pageData v-on:page-changed="loadPosts"></Pagination>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Pagination from '../navigation/pagination.vue';

export default {
    name: 'postsList',
    components: { Pagination },
    data: function () {
        return {

        }
    },
    methods: {
        // Load posts list on current page.
        loadPosts: function(page) {
            this.$store.dispatch("loadPosts", page);
        }
    },
    computed: {
        // Vuex  getters helper for posts and pageData state.
        ...mapGetters([
            'posts',
            'pageData'
        ])
    },
    mounted: async function() {
        // Initialise posts list on page number 1.
        try {

            await this.$store.dispatch("loadPosts", 'posts?page=1');

        } catch (error) {
            console.log(error.response.data)
        }



    }
}

</script>