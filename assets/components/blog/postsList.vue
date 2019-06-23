<template>
    <div>
        <!-- Pass props at default slot -->
        <slot v-bind:posts="posts"></slot>
        <Pagination v-bind:pageData = pageData v-on:page-changed="loadPosts"></Pagination>
    </div>
</template>
<script>

import Pagination from './pagination.vue';

export default {
    name: 'postsList',
    components: { Pagination },
    data: function () {
        return {

        }
    },
    methods: {
        loadPosts: function(page) {
            console.log(page);
            this.$store.dispatch("loadPosts", page);
        }


    },

    computed: {
        posts: function() {
            return this.$store.state.posts;
        },
        pageData: function() {
            return this.$store.state.pageData;
        }
    },
    mounted: function() {
        this.$store.dispatch("loadPosts", 'api/posts?page=1');

    }

}

</script>