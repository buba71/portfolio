<template>
    <div>
        <div v-if="message" class="alert alert-success">
            <span>{{ message }}</span>
        </div>

    </div>
</template>
<script>

export default {
    name: 'FlashMessage',
    computed: {
        message: function () {
            return this.$store.getters.successMsg;
        }
    }
}
</script>