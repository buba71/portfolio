<template>
    <div>
        <div class="post-card border border-light">
            <h1>Ajouter un article</h1>
            <form v-on:submit.prevent="createPost">
                <div class="form-group">
                    <label></label>
                    <input type="text" class="form-control" v-model="post.title">
                </div>
                <div class="form-group">
                    <ckeditor :editor="editor" v-model="post.content" tag-name="textarea"></ckeditor>
                </div>
                <div class="form-group">
                    <label></label>
                    <input type="text" class="form-control" v-model="post.tags">
                </div>
                <button type="submit" class="btn btn-primary btn-md">Valider</button>
                <button type="button" class="btn btn-secondary btn-md" v-on:click="cancelAdd">Annuler</button>
            </form>
        </div>

    </div>

</template>
<script>
import Axios from 'axios';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    name: 'CreatePost',
    components: { ckeditor: CKEditor.component },
    data: function() {
        return {
            post: {
                title: '',
                content: '',
                tags: ''
            },
            editor: ClassicEditor
        }
    },
    methods: {
        // create new post
        createPost: function() {
            let tagsArray = this.inputTagsToArray(this.post.tags);
            Axios.post(`api/posts`, { title: this.post.title, content: this.post.content, tags: tagsArray } )
                // Redirect to postList and display success msg or error msg
                .then((response) => {
                    this.$store.dispatch('displayMsg', 'Article ajouté avec succès.');
                    this.$router.push('/');
                })
                .catch((error) => {
                    this.$store.dispatch('displayMsg', 'UNe errreur s\'est produite');
                })
        },
        // Convert Input string tags into Array of objects (Data transformer).
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
        cancelAdd: function() {
            this.$router.push('/');
        }
    }

}
</script>