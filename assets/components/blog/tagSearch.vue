<template>
    <div>
        <div id="tag-content">
            <ul class="tag-list">
                <li class="tag-item d-flex justify-content-center"
                    v-for="(tag, index) in tags"  v-bind:id="index"
                    v-bind:style="{'border-color': changeTagColor(index)}"
                    v-on:mouseover="applyStyleOnHover(index)"
                    v-on:mouseleave="removeStyleOnLeave(index)"
                    v-on:click="searchPostsByTag(tag.name)">{{ tag.name }}
                </li>
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
            tags: [],
            arrayTagColor: []
        }
    },
    methods: {
        searchPostsByTag: function(tag) {
            this.$store.dispatch("loadPostsByTag", tag);
        },
        changeTagColor: function(index) {
            const colors = ['red', 'turquoise', 'blue', 'chocolate', 'purple'];
            let tagColor = colors[Math.floor( Math.random() * colors.length)];
            this.arrayTagColor[index] = tagColor;
            return tagColor;
        },
         applyStyleOnHover: function(index) {
            // Looking for the tag who have been over with index.
            for(let i = 0; i < this.tags.length; i++) {
                if(index === i) {
                    let elementList = document.getElementById(i);
                    elementList.style.backgroundColor = this.arrayTagColor[i];
                    elementList.style.color = 'white';
                }
            }
         },
        removeStyleOnLeave: function(index) {
            for(let i = 0; i < this.tags.length; i++) {
                if(index === i) {
                    let elementList = document.getElementById(i);
                    elementList.style.removeProperty('background-color');
                    elementList.style.removeProperty('color');
                }
            }
        }

    },
    mounted: async function() {
        let { data } = await Axios.get('api/tags');
            console.log(data);
            this.tags = data["hydra:member"];
    }
}

</script>
