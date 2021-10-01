<template>
    <div>
        <!-- Navigation -->
        <bread-crumb v-if="hasSearchTag"></bread-crumb>
        <h1 id="blog-title" class="d-flex justify-content-center"style="color: #8c8c8c; margin-bottom: 50px">Blog david-de-lima.com</h1>

        <!-- Display Tags -->
        <tag-search></tag-search>

        <!-- Posts list -->
        <posts-list>
            <template v-slot:default="slotProps">
                <div v-if="slotProps.posts.length > 0">
                    <!-- Post details -->
                    <article class="card post-item" v-for="post in slotProps.posts">
                        <div class="title-box">
                            <h2>{{ post.title }}</h2>

                            <ul class="tag-list" >
                                <li class="tag-item d-flex justify-content-center" v-for="tag in post.tags">{{ tag.name }}</li>
                            </ul>
                        </div>
                        <div class="postInfo">
                            <i class="far fa-calendar-alt"></i> {{ post.postDate | formatDate}}
                            <i class="far fa-comment-alt"></i> {{ post.comments.length }}
                        </div>

                        <div class="postContent" v-html="$options.filters.truncate(post.content)"></div>

                        <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug  }}">
                            <div class="fullPost">
                                <i class="fas fa-angle-double-right"></i><span> Lire la suite</span>
                            </div>
                        </router-link>
                    </article>
                    <!-- Post details -->
                </div>

                <div v-else class="mb-4">Il n'y a pas d'article pour le moment.</div>

            </template>

        </posts-list>

        <!-- Posts list -->
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
import truncate from "../../utils/filters.js";
import PostsList from '../../components/blog/postsList';
import TagSearch from '../../components/blog/tagSearch';
import BreadCrumb from '../../components/navigation/breadCrumb.vue';

export default {
    name: 'blogIndex',
    components: { PostsList, TagSearch, BreadCrumb },
    computed: {
        ...mapGetters(['hasSearchTag']),
    },
    filters: {
        truncate,
    }
}
</script>