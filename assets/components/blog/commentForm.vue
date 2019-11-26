<template>
  <div>
    <form
          v-on:submit.prevent="onSubmitComment"
          id="comment-form"
    >
      <div class="form-group">
        <input 
          v-model="comment.author" 
          type="text" 
          placeholder="Pseudonyme"
          class="form-control mt-2 mb-2"
        >
      </div>
      <span v-if="authorError">{{ authorError.message }}</span>
      <div class="form-group">
        <textarea
          v-model="comment.content"
          placeholder="Votre commentaire"
          class="form-control"
          rows="4"
        ></textarea>
      </div>
      <span v-if="contentError">{{ contentError.message }}</span><br/>
      <button
        type="submit"
        class="btn btn-default btn-sm ml-0"
      >
        Commenter
      </button>
    </form>

  </div>
</template>

<script>

export default {
    name: 'CommentForm',
    data: function () {
        return {
            comment: {
                author: '',
                content: '',
                post: `/api/posts/ ${this.$route.params.id}`
            },
            errors: []
        }
    },
    computed: {
        // Return author input form errors if has any(Not Blank).
        authorError: function() {
            const errorMsg = this.errors.filter((error) => { return  error.propertyPath === "author"});
            return errorMsg.shift();
        },
      // Return content input form errors if has(NotBlank).
        contentError: function() {
            const errorMsg = this.errors.filter((error) => { return error.propertyPath === "content"});
            return errorMsg.shift();
        }
    },
    methods: {
        // If comment is submitted, flush comment in Bdd and display message.
        onSubmitComment: async function() {
            try {
                await this.$store.dispatch("postComment", this.comment);
                await this.$store.dispatch("displayMsg", "Votre commentaire à été ajouté avec succès.");
                // Reinit vars.
                this.comment.author = '';
                this.comment.content = '';
                this.errors = [];

            } catch (error) {
                if (error.response.status === 400) {
                    this.errors = error.response.data.violations;
                }
            }
        }
    },


}
</script>