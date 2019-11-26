<template>
  <div>
    <bread-crumb :post-title="post.title" />

    <flash-message />

    <article>
      <h1 class="post-title">{{ post.title }}</h1>
      <p v-html="post.content"/>
    </article>

    <comments />
  </div>
</template>
<script>

import BreadCrumb from "../../components/navigation/breadCrumb.vue";
import FlashMessage from "../../components/blog/flashMessage.vue";
import Comments from "../../components/blog/comments.vue";

export default {
    name: 'PostDetails',
    components: {BreadCrumb, FlashMessage, Comments},
    data: function() {
        return {

        }
    },
    computed: {
      post: function () {
        return this.$store.getters.getPost;
      }
    },
    watch: {
        '$route'(to, from) {
            this.fetchPost();
        }
    },
    mounted: function() {
        this.fetchPost();

    },
    methods: {
      // Fetch the post to display.
      fetchPost: async function() {
        // Init Post with the post id.
        let post = this.$route.params.id;

        try {

          await this.$store.dispatch("fetchPostDetails", post);

        } catch (error) {
          // Page (id post) not found.
          if (error.response.status === 404) {
            this.$router.push('/404');
            console.log(error.response.data);
          }
        }
      }
    },


}
</script>