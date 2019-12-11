<template>
    <textarea
        v-model="message"
        @keydown.enter="send"
        class="form-control border-0 rounded-top-0"
        placeholder="Message..."></textarea>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        }
    }
</script>
