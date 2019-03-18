<template>
    <!-- Form Contact -->
    <div>
    <form v-on:submit.prevent="submitMail" class="text-center">
        <div v-if="success && !submitting" class="alert alert-success text-center">
            <span> Votre message a été envoyé avec succès.</span>
        </div>
        <div class="row mb3">
            <!-- Last Name -->
            <div class="col-sm-6">
                <div class="md-form">
                    <input type="text" id="lastName" class="form-control" v-model="form.lastName">
                    <label for="lastName">Nom</label>
                </div>
                <span class="form-error" v-for="error in errors" v-if="error.propertyPath === 'senderLastName'">{{ error.message }}</span>
            </div>
            <!-- Last Name -->

            <!-- First Name -->
            <div class="col-sm-6">
                <div class="md-form">
                    <input type="text" id="firstName" class="form-control" v-model="form.firstName">
                    <label for="firstName">Prénom</label>
                </div>
                <span class="form-error" v-for="error in errors" v-if="error.propertyPath === 'senderFirstName'">{{ error.message}}</span>
            </div>
            <!-- First Name -->
        </div>

        <!-- Email -->
        <div class="md-form mb-4">
            <input type="email" id="senderEmail" class="form-control" v-model="form.senderEmail">
            <label for="senderEmail">Adresse mail</label>
        </div>
        <span class="form-error" v-for="error in errors" v-if="error.propertyPath === 'senderMail'">{{ error.message }}</span>
        <!-- Email -->

        <!-- Subject -->
        <div class="md-form mb-4">
            <input type="text" id="messageObj" class="form-control" v-model="form.messageObj">
            <label for="messageObj">Sujet de votre message</label>
            <small class="form-text text-muted mb-4">
                Optionel
            </small>
        </div>
        <!-- Subject -->

        <!-- Content -->
        <div class="md-form mb-4">
            <textarea id="message" class="form-control md-textarea" rows="6" v-model="form.content"></textarea>
            <label for="lastName"><i class="fas fa-pencil-alt"></i> Votre message</label>
        </div>
        <span class="form-error" v-for="error in errors" v-if="error.propertyPath === 'content'">{{ error.message }}</span><br/>
        <!-- Content -->

        <!-- Submit button -->
            <button type="submit" class="btn btn-default">
                <span>Envoyer <span v-if="submitting" class="fa fa-spinner fa-x fa-spin"></span></span>
            </button>
        <!-- Submit button -->
    </form>
    </div>
    <!-- Form Contact -->
</template>

<script type="application/ecmascript">

import axios from 'axios';

export default {
    name: 'contactForm',
    data: function () {
        return {
            errors: [],
            form: {
                lastName: '',
                firstName: '',
                senderEmail: '',
                messageObj: '',
                content: ''
            },
            success: false,
            submitting: false,
        }
    },
    methods: {
        submitMail: function () {
            let $this = this;
            this.submitting = true;
            console.log('submitting' + this.submitting);

            axios.post('/api/messages', {
                senderFirstName: this.form.firstName,
                senderLastName: this.form.lastName,
                senderMail: this.form.senderEmail,
                messageObj: this.form.messageObj,
                content: this.form.content
            })
                .then(function (response) {

                    $this.success = true;
                    $this.submitting = false;
                    console.log('submitting' + $this.submitting);

                    Object.keys($this.form).forEach(function(item) {
                        $this.form[item] = '';
                    });

                    $this.errors = [];

                    console.log($this.form);

                })
                .catch(function (error) {

                    if (error.response.status === 400) {
                        $this.errors = error.response.data.violations;
                        console.log($this.errors);

                        $this.submitting = false;
                        console.log('submitting' + $this.submitting);

                    }

                });




        }
    }
}
</script>
