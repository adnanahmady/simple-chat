<template>
    <textarea
        v-model="message"
        @keydown.enter.prevent="send"
        class="form-control border-0 rounded-top-0"
        placeholder="Message..."></textarea>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },

        methods: {
            send() {
                if (this.message.length == 0) return;

                this.$emit('sendMessage', this.message);
                this.message = '';
            }
        }
    }
</script>
