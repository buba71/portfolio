<template>
    <div>
        <tag-search></tag-search>
        <h1>Liste des articles</h1>
        <posts-list>
            <template v-slot:default="slotProps">

                <article class="card post-item" v-for="post in slotProps.posts">
                    <div class="postTitle">
                        <h2>{{ post.title }}</h2>

                        <ul class="tag-list" >
                            <li class="tag-item d-flex justify-content-center" v-for="tag in post.tags">{{ tag.name }}</li>
                        </ul>
                    </div>
                    <div class="postInfo">
                        <i class="far fa-calendar-alt"></i> {{ post.postDate | formatDate}}
                    </div>

                    <div class="postContent" v-html="post.content"></div>

                    <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug  }}">
                        <div class="fullPost">
                            <i class="fas fa-angle-double-right"></i><span> Lire la suite</span>
                        </div>
                    </router-link>
                </article>

            </template>

        </posts-list>
    </div>

</template>
<script>
import PostsList from './postsList';
import TagSearch from './tagSearch';

export default {
    name: 'blogIndex',
    components: { PostsList, TagSearch }
}
</script>