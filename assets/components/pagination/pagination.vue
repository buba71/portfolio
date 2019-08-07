<template>
    <nav id="navbar-pagination" aria-label="Page navigation example">

        <ul class="pagination pg-blue">
            <li class="page-item " v-if="isUniquePage" v-bind:class="{ disabled : isInfirstPage }" v-on:click="onClickPreviousPage(pageData.previousPage)">
                <a class="page-link" tabindex="-1">Précédente</a>
            </li>
            <li class="page-item" v-bind:class="{ active: page.isActive }" v-for="page in pages" v-on:click="onClickPage(page.name)"><a class="page-link">{{ page.name }}</a></li>

            <li class="page-item" v-if="isUniquePage" v-bind:class="{ disabled: isInLastPage}" v-on:click="onClickNextPage(pageData.nextPage)">
                <a class="page-link">Suivante</a>
            </li>
        </ul>
    </nav>
</template>
<script type="text/javascript">

export default {
    name: 'pagination',
    props: ['pageData'],
    data: function() {
        return {

        }
    },
    computed: {
        pages: function() {
            const range = [];
            for(let i = 1; i<= this.pageData.totalPage; i++) {
                range.push({
                    name: i,
                    isActive: i == this.pageData.currentPage
                });
            }
            return range;
        },
        isUniquePage: function() {
            return this.pageData.totalPage > 1;
        },

        isInfirstPage: function() {
            return this.pageData.currentPage == 1;
        },

        isInLastPage: function() {
            return this.pageData.currentPage ==  this.pageData.totalPage;
        },
        urlTemplate: function() {
            // generate url when user click on pagination number :  "api/posts?tags.name=[]&page=" or "api/posts?page="
            let url = this.pageData.template;
            return url.substring(1, url.length -1);
        }
    },
    methods: {
        onClickPreviousPage: function(page) {
            this.$emit('page-changed', page );
            this.pageData.currentPage = page.substr(-1, 1);
        },
        onClickPage: function(page) {
            this.$emit('page-changed', this.urlTemplate + page);
            this.pageData.currentPage = page;
        },
        onClickNextPage: function(page) {
            this.$emit('page-changed', page );
            this.pageData.currentPage = page.substr(-1, 1);
        }
    }
}
</script>
