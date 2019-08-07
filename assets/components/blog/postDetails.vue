<template>
    <div>
        <bread-crumb v-bind:postTitle="post.title"></bread-crumb>
        <article>
            <h1>{{ post.title}}</h1>
            <p v-html="post.content"></p>
        </article>
    </div>
</template>
<script>

import Axios from 'axios';
import BreadCrumb from "../navigation/breadCrumb";
export default {
    name: 'PostDetails',
    components: {BreadCrumb},
    data: function() {
        return {
            post: {
                title: '',
                content: ''
            }
        }
    },
    watch: {
        '$route'(to, from) {
            this.fetchPost();
        }
    },
    methods: {
      // Fetch the post to display.
      fetchPost: function() {
          let post = this.$route.params.id;
          Axios(`api/posts/ ${post}`)
              .then((response) => {
                  this.post.title = response.data.title;
                  this.post.content = response.data.content;
              })
              // Page(id post) not found
              .catch((error) => {
                  if(error.response.status === 404) {
                      this.$router.push('/404');
                  }
              })
      }
    },
    mounted: function() {
        this.fetchPost();

    }

}
</script>