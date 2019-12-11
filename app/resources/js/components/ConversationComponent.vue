<template>
    <div class="col">
        <div v-for="message in messages"
            :key="message.id"
            :class="`w-50 my-3 rounded p-2 ${message.to == content.id ? 'bg-info ml-auto' : 'bg-light mr-auto'}`"
        >{{ message.text }}</div>
    </div>
</template>

<script>
    export default {
        props: {
            content: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
    }
</script>
