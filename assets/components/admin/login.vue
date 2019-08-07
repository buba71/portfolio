<template>
    <div class="d-flex justify-content-center">
        <form v-on:submit.prevent="login" class="text-center border border-light w-50 p-5">
            <p class="h4 mb-4">Veuillez vous identifier</p>
            <div v-if="error" class="alert alert-danger">
                <span>Vos identifiants sont erronés.</span>
            </div>
            <div class="md-form">
                <label for="login">login</label>
                <input type="text" id="login" v-model="username" class="form-control" required >
            </div>
            <div class="md-form">
                <label for="password">password</label>
                <input type="password" id="password" v-model="password" class="form-control" required >
            </div>
            <button type="submit" class="btn btn-info">Valider</button>
        </form>
    </div>
</template>
<script type="text/javascript">
import Axios from 'axios';

export default {
    name: 'login',
    data: () => {
        return {
            username: 'd.delima@outlook.fr',
            password: 'Yqpkaqrv1',
            error: false
        }
    },
    methods: {
        // This function is used to logging user admin and generating Token (see symfony security component).
        login: async function () {
            try {
                let { data } = await Axios.post('/api/login_check', { username: this.username, password: this.password});
                // User is authenticated -> redirect to index page admin.
                this.$store.commit('AUTH_ADMIN', data.data.isLogin); // Payload: isLogin state.
                this.$router.push('/');
            } catch (error) {
                console.log(error.response.status);
                if(error.response.status === 401) {
                    this.error = true;                              // Bad credentials.
                } else {
                    this.$router.push('/404');
                }
            }
        }
    },
}
</script>