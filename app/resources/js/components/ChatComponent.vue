<template>
    <div class="row">
        <div class="col-8 d-flex">
            <content-component :content="selectedContent" :messages="messages"></content-component>
        </div>
        <div class="col-4 overflow-auto" style="max-height: 68vh;">
            <contacts-component :contacts="contacts" @selected="contactSelected"></contacts-component>
        </div>
    </div>
</template>

<script>
    import ContentComponent from "./ContentComponent";
    import ContactsComponent from "./ContactsComponent";

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },

        components: {ContentComponent, ContactsComponent},

        data() {
            return {
                selectedContent: {},
                messages: [],
                contacts: []
            }
        },
        mounted() {
            Echo.private('messages.' + this.user.id)
                .listen('.new.message', this.handleMessage);

            axios.get('/api/contacts')
                .then(({data: _response}) => this.contacts = _response)
                .catch(data => console.log(data));
        },

        methods: {
            contactSelected({index, contact}) {
                axios.get('/api/conversations/' + contact.id)
                    .then(({data}) => {
                        this.selectedContent = contact;
                        this.messages = data;
                    })
                    .catch(data => console.log(data.response));
            },

            handleMessage({message}) {
                if (+this.user.id === +message.to) {
                    return this.messages.push(message);
                }

                // todo
            }
        }
    }
</script>
