<template>
    <div>
        <div class="mt-5">
            <span><strong>Laisser un commentaire:</strong></span>
            <hr class="mt-1">
        </div>

        <!-- Comment form -->
        <div class="comment-form">
            <comment-form v-bind:comments="getPost.comments"></comment-form>
        </div>
        <!-- Comment form -->

        <!-- Fil des commentaire -->
        <div id="comments-thread" class="mt-5">
            <div
                    v-for="comment in getPost.comments"
                    v-bind:id=" `comment-${comment.id}`"
                    v-bind:key="comment.id"
                    class="comment-body mb-4"
            >
                <div class="comment-header">
                    <span class="comment-author"><strong>{{ comment.author }}</strong></span>
                    <span class="comment-date"> - {{ comment.createdAt | formatDate }} -</span>
                </div>
                <div class="comment-content">

                    <p>{{ comment.content }}</p>

                </div>
            </div>
        </div>
        <!-- Fil des commentaires -->

    </div>
</template>
<script type="text/babel">
import CommentForm from "./commentForm.vue";
import { mapGetters } from "vuex";

export default {
    name: 'Comments',
    components: { CommentForm },
    computed: {
        ...mapGetters([
            'getPost'
        ])
    }

}

</script>