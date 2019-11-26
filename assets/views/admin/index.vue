<template>
    <div>
        <!-- Tabs -->
        <ul class="nav nav-tabs mt-5 mr-5 ml-5"  id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#blog-admin" role="tab" aria-controls="home"
                   aria-selected="true">Administration du blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mail-admin" role="tab" aria-controls="profile"
                   aria-selected="false">Administration des mails</a>
            </li>
        </ul>
        <!-- Tabs -->

        <!-- Posts admin -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mr-5 ml-5" id="blog-admin" role="tabpanel" aria-labelledby="home-tab">
                <posts-list>
                    <template v-slot:default="slotProps">
                        <table v-if="slotProps.posts.length > 0 " class="table table-striped mt-5">
                            <thead class="info-color-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Contenu</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post in slotProps.posts" v-bind:key="post.id" v-bind:id="post.id">
                                <th>{{ post.postDate | formatDate }}</th>
                                <th>{{ post.title }}, {{ post.id }}</th>
                                <th v-html="$options.filters.truncate(post.content)"></th>
                                <th>
                                    <router-link :to="{ name: 'postEdit', params: { id: post.id }}">
                                        <i class="fas fa-edit"></i>
                                    </router-link>

                                    <!-- Button trigger modal -->
                                    <i class="fas fa-trash-alt" data-toggle="modal" v-bind:data-target="`#post${post.id}`">
                                    </i>

                                    <!-- Modal -->
                                    <div class="modal fade" v-bind:id="`post${post.id}`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous vraiment supprimer cet article ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Annuler</button>
                                                    <button type="button" class="btn btn-primary btn-md" data-dismiss="modal" v-on:click="removePost(post.id)">valider</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                </th>
                            </tr>
                            </tbody>
                        </table>

                        <div v-else class="mt-4 mb-4">Vous n'avez pas encore rédigé d'article.</div>

                    </template>

                </posts-list>

                <router-link :to="{ name: 'postCreate'}">
                    <button class="btn btn-primary btn-sm"> Ajouter un article</button>
                </router-link>
            </div>
            <!-- Posts admin -->

            <!-- Mails admin -->
            <div class="tab-pane fade mr-5 ml-5" id="mail-admin" role="tabpanel" aria-labelledby="profile-tab">
                <table v-if="mails.length > 0" class="table table-striped mt-5">
                    <thead class="black info-color">
                    <tr>
                        <th scope="col">Envoyé le</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse mail</th>
                        <th scope="col">Objet</th>
                        <th scope="col">Contenu</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="mail in mails">
                        <td class="align-middle">{{ mail.sendedAt | formatDate }}</td>
                        <td class="align-middle">{{ mail.senderFirstName }}</td>
                        <td class="align-middle">{{ mail.senderLastName }}</td>
                        <td class="align-middle">{{ mail.senderMail }}</td>
                        <td class="align-middle">{{ mail.messageObj }}</td>
                        <td class="align-middle">{{ mail.content }}</td>
                        <td>
                            <i class="fas fa-trash-alt " v-on:click="removeMail(mail.id)"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="mt-4"> Vous n'avez pas de courrier.</div>
            </div>
            <!-- Mails admin -->
        </div>
    </div>

</template>
<script>
    import Axios from 'axios';
    import truncate from '../../utils/filters.js';
    import PostsList from '../../components/blog/postsList.vue';

    export default {
    name: 'adminPanel',
    components: { PostsList },
    data: function () {
        return {
            mails: [],
            //posts: []
        }
    },
    mounted: function () {
        this.fetchEmails();
    },
    filters: {
        truncate
    },
    methods: {
        fetchEmails: function () {
            Axios.get(`messages`)
                .then((response) => {
                    this.mails = response.data['hydra:member'];
                })
                .catch((error)=> {
                    console.log(error.response);
                });
        },
        removeMail: function(id) {
            Axios.delete(`messages/ ${id}`)
                .then(() => {
                    this.$store.dispatch('displayMsg', 'Courrier supprimé.')
                    this.fetchEmails();
                });

        },
        removePost: async function(id) {
            try {
                await this.$store.dispatch("removePost", id);
                await this.$store.dispatch('displayMsg', 'Article supprimé.');
            } catch(error) {
                console.log(error.response.data);
            }


        },
    },
}
</script>