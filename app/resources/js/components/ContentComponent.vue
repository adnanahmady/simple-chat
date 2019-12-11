<template>
    <div class="row flex-grow-1">
        <div class="col d-flex flex-column">
            <header class="rounded-top border border-bottom-0 p-2">
                <strong v-text="contentName"></strong>
            </header>
            <main class="flex-grow-1 bg-secondary border overflow-auto" style="height: 100vh;max-height: 100vh;">
                <conversation-component :messages="messages" :content="content"></conversation-component>
            </main>
            <footer class="border border-top-0 rounded-bottom">
                <new-message-component @send="newMessage"></new-message-component>
            </footer>
        </div>
    </div>
</template>

<script>
    import ConversationComponent from "./ConversationComponent";
    import NewMessageComponent from "./NewMessageComponent";

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

        components: {ConversationComponent, NewMessageComponent},

        computed: {
            contentName() { return this.content.name ? this.content.name : 'Choose a contact...'; }
        },

        mounted() {
            console.log('content mounted');
        },

        methods: {
            newMessage(text) {
                console.log('new message presived: ' + text);
            }
        }
    }
</script>
