<template>
    <div>
        <!-- Pass props at default slot -->
        <slot v-bind:posts="posts"></slot>
        <Pagination v-bind:pageData = pageData v-on:page-changed="loadPosts"></Pagination>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Pagination from '../pagination/pagination.vue';

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
            console.log(page);
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
    mounted: function() {
        // Initialise posts list on page number 1.
        this.$store.dispatch("loadPosts", 'api/posts?page=1');

    }
}

</script>