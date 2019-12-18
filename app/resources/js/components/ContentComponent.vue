<template>
    <div class="row flex-grow-1">
        <div class="col d-flex flex-column">
            <header class="rounded-top border border-bottom-0 p-2">
                <strong v-text="contentName"></strong>
            </header>
            <main class="flex-grow-1 bg-secondary border overflow-auto"
                  style="height: 55vh;max-height: 55vh;"
                  ref="feed"
            >
                <conversation-component :messages="messages" :content="content"></conversation-component>
            </main>
            <footer class="border border-top-0 rounded-bottom">
                <new-message-component @sendMessage="newMessage"></new-message-component>
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
            contentName() {
                return this.content.name ? this.content.name : 'Choose a contact...';
            }
        },

        mounted() {
        },

        updated() {
            this.scrollDown();
        },

        methods: {
            newMessage(text) {
                axios.post('/api/conversations', {
                    content_id: this.content.id,
                    text: text
                })
                    .then(({data: response}) => this.messages.push(response))
                    .catch(data => console.log(data));
            },

            scrollDown() {
                setTimeout( () =>
                        this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight
                    , 50);
            }
        },

        // watch: {
        //     content() { this.scrollDown(); },
        //     messages() { this.scrollDown(); }
        // }
    }
</script>
