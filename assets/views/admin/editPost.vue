<template>
    <div>
        <div class="post-card border border-light">
            <h1>Modifier cet article</h1>
            <form v-on:submit.prevent="updatePost">
                <div class="form-group">
                    <label for="post-title" >Titre</label>
                    <input type="text" class="form-control" id="post-title" v-model="post.title">
                </div>
                <div class="form-group">
                    <label for post-content>Contenu</label>
                    <ckeditor :editor="editor" v-model="post.content" tag-name="textarea" id="post-content"></ckeditor>
                </div>
                <div class="form-group">
                    <label for="post-tags">Tags</label>
                    <input type="text" class="form-control" id="post-tags" v-model="post.tags">
                </div>
                <button type="submit" class="btn btn-primary btn-md">Modifier</button>
                <button type="button" class="btn btn-secondary btn-md" v-on:click="cancelEdit">Annuler</button>
            </form>
        </div>
    </div>
</template>
<script>
import Axios from 'axios';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    name: 'EditPost',
    components: { ckeditor: CKEditor.component },
    data: function() {
        return {
            postId : this.$route.params.id,
            post: {
                title: '',
                content: '',
                tags: ''
            },
            editor: ClassicEditor
        }
    },
    mounted: function() {

        Axios.get(`api/posts/ ${this.postId}`)
            .then((response) => {
                this.post.title = response.data.title;
                this.post.content = response.data.content;
                this.post.tags = this.bddTagsToString(response.data.tags);
            });
    },
    methods: {
        // Update the post with new data
        updatePost: function() {
            let tagsArray = this.inputTagsToArray(this.post.tags);
            Axios.put(`api/posts/ ${this.postId}`, { title: this.post.title, content: this.post.content, tags: tagsArray })
            // Redirect to postList and display success msg or error msg.
                .then((response) => {
                    this.$store.dispatch('displayMsg', 'Article modifié avec succès.');
                    this.$router.push('/');
                })
                .catch((error) => {
                    this.$store.dispatch('displayMsg', 'Une erreur s\'est produite.');
                })
        },
        // Convert tags objects into string for displaying into form.
        bddTagsToString: function(tags) {
            return Object.keys(tags).map((key) => {
                return tags[key].name;
            }).toString();


        },
        // Convert input string tags into Array of objects (Data Transformer).
        inputTagsToArray: function(tags) {

            if(tags.length > 0) {
                // Tag constructor
                function Tag(name) {
                    this.name = name;
                }
                // Adding filters to unique name tag, delete spaces,...
                return (tags.split(',')).map((inputTag) => { return new Tag(inputTag); });
            } else {
                return [];
            }
        },
        cancelEdit: function() {
            this.$router.push('/');
        }

    }
}


</script>