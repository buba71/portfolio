<template>
    <div>
        <form v-on:submit.prevent="updatePost">
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
            <button type="submit" class="btn btn-info">Modifier</button>
        </form>
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
                console.log(response.data);
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
                // Redirect to postList and displey success msg or error msg
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error.response.data);
                })
        },
        // Convert Array of objects tags into string for display in form
        bddTagsToString: function(tags) {
            return tags.map((value) => { return value.name; }).toString();
        },
        // Convert input string tags into Array of objects (Data Transformer).
        inputTagsToArray: function(tags) {

            // Tag constructor
            function Tag(name) {
                this.name = name;
            }

            return (tags.split(',')).map((inputTag) => { return new Tag(inputTag); });

        }

    }
}


</script>