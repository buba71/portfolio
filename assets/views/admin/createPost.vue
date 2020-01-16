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
                    <vue-ckeditor  :config="config" v-model="post.content"/>
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

//import CKEditor from '@ckeditor/ckeditor5-vue';
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
//import CodeSnippet from 'ckeditor5-code-snippet-plugin';
import VueCkeditor from 'vue-ckeditor2';
import EditorConfig from "../../config/CkeditorConfig.js";

export default {
    name: 'CreatePost',
    components: { VueCkeditor },
    data: function() {
        return {
            post: {
                title: '',
                content: '',
                tags: ''
            },
            errors: [],
            config: EditorConfig
        }
    },
    methods: {
        // create new post
        createPost: async function() {
            // Convert input Post tags string into object array.
            this.post.tags = this.inputTagsToArray(this.post.tags);

            try {
               await this.$store.dispatch("createPost", this.post);
               await this.$store.dispatch("displayMsg", "Article ajouté avec succès.");
               this.$router.push('/');
            } catch(error) {
                if (error.response.status === 400) {
                    this.errors = error.response.data.violations;
                    console.log(this.errors);
                } else {
                    this.$router.push('/404');
                }
            }
        },
        // Convert Input string tags into Array of objects (Data transformer).
        inputTagsToArray: function(tags) {

            if(tags.length > 0) {
                // Tag constructor
                let Tag = function (name) {
                    this.name = name;
                };
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