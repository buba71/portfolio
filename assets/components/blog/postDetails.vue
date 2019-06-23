<template>
    <div>
        <article>
            <h1>{{ post.title}}</h1>
            <p v-html="post.content"></p>
        </article>
    </div>
</template>
<script>

import Axios from 'axios';
export default {
    name: 'PostDetails',
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
      fetchPost: function() {
          let post = this.$route.params.id;
          Axios('api/posts/' + post)
              .then((response) => {
                  this.post.title = response.data.title;
                  this.post.content = response.data.content;
              })
              // Page(id post) not found
              .catch((error) => {
                  if(error.response.status === 404) {
                      this.$router.push('/');
                  }
              })
      }
    },
    mounted: function() {
        this.fetchPost();

    }

}
</script>