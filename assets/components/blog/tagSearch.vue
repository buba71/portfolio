<template>
    <div>
        <div id="tag-content">
            <ul class="tag-list">
                <li class="tag-item d-flex justify-content-center" v-for="tag in tags" v-on:click="searchPostsByTag(tag.name)">{{ tag.name }}</li>
            </ul>
        </div>
    </div>
</template>
<script>
import Axios from 'axios';

export default {
    name: 'tagSearch',
    data: function() {
        return {
            tags: []
        }
    },
    methods: {
        searchPostsByTag: function(tag) {
            this.$store.dispatch("loadPostsByTag", tag);
        }

    },
    mounted: function() {
        Axios.get('api/tags')
            .then((response) => {
                this.tags = response.data["hydra:member"]

            })
    }
}

</script>
