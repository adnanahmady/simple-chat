<template>
    <div class="row">
        <div class="col-8">
            <content-component :content="selectedContent" :messages="messages"></content-component>
        </div>
        <div class="col-4">
            <contacts-component :contacts="contacts"></contacts-component>
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
                selectedContent: null,
                messages: [],
                contacts: []
            }
        },
        mounted() {
            axios.get('/api/contacts')
            .then(({data: _response}) => this.contacts = _response)
            .catch(data => console.log(data));
        }
    }
</script>
