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
                    <vue-ckeditor :config="config" v-model="post.content" id="post-content"></vue-ckeditor>
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
import VueCkeditor from "vue-ckeditor2";
import EditorConfig from "../../config/CkeditorConfig.js";


export default {
    name: 'EditPost',
    components: { VueCkeditor },
    data: function() {
        return {
            post: {
                id: this.$route.params.id,
                title: '',
                content: '',
                tags: ''
            },
            errors: [],
            config: EditorConfig
        }
    },
    mounted: function() {
        Axios.get(`posts/ ${this.post.id}`)
            .then((response) => {
                this.post.title = response.data.title;
                this.post.content = response.data.content;
                this.post.tags = this.bddTagsToString(response.data.tags);
            })
            .catch((error) => {
                console.log("error", error.response.data);
                this.$router.push('')
            });
    },
    methods: {
        // Update the post with new data
        updatePost: async function() {
            // Convert input Post tags string into object array.
            this.post.tags = this.inputTagsToArray(this.post.tags);

            try {
                await this.$store.dispatch("updatePost", this.post);
                await this.$store.dispatch("displayMsg", 'Article modifié avec succès.');
                this.$router.push('/');

            } catch(error) {
                if (error.response.status === 400) {
                    this.errors = error.response.data.violations;
                } else {
                    this.$router.push('/404');
                }
            }
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
                let Tag = function(name) {
                    this.name = name;
                };
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