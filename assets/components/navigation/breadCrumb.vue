<template>
    <div>
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb white">
                <li class="breadcrumb-item" v-on:click="refetchPosts">
                    <a href="#" >Retour à la liste de tous les articles</a>
                </li>
                <li v-if="hasSearchTag" class="breadcrumb-item" v-bind:class="{ active: !postTitle}">
                    {{ pickedTag }}
                </li>
                <li v-if="postTitle" class="breadcrumb-item active">
                    {{ postTitle }}
                </li>
            </ol>
        </nav>
    </div>
</template>
<script type="text/javascript">

export default {
    name: 'BreadCrumb',
    props: ['postTitle'],
    // Use of mapGetters for v2.
    computed: {
        pickedTag: function () {
            return this.$store.getters.pickedTag;
        },
        hasSearchTag: function () {
            return this.$store.getters.hasSearchTag;
        }
    },
    methods: {
        // Reload the posts list when click on "Return to posts list link.
        refetchPosts: function () {
            if(this.pickedTag && this.postTitle) {
                this.$store.commit('CLOSE_SEARCH_TAG');                     // Disable the breadCrumb when reload index
                this.$router.push('/');
            } else if (this.postTitle){
                this.$router.push('/');
            } else if(this.pickedTag){
                this.$store.commit('CLOSE_SEARCH_TAG');
                this.$store.dispatch("loadPosts", 'posts?page=1');
            }
        },
        refresh: function () {
            //Some code...
        }
    }
}
</script>