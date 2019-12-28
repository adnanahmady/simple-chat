<template>
    <ul class="list-group">
        <li :class="`list-group-item
                    list-group-item-light
                    list-group-item-action
                    ${selectedId === contact.id && 'bg-selected'}`"
            style="cursor: pointer"
            v-for="(contact) in sortedContacts"
            :key="contact.id"
            @click="contactSelected(contact)">
            <div class="row">
                <div class="avatar col-3">
                    <img
                        :src="contact.profile_image"
                        width="50"
                        class="img-fluid rounded-circle"
                        :alt="contact.name">
                </div>
                <div class="col-8">
                    <div class="name text-dark strong" v-text="contact.email"></div>
                    <div class="name text-secondary strong" v-text="contact.name"></div>
                </div>
                <div
                    class="col-1 d-flex position-absolute"
                    style="justify-content: center;align-items: center;right: 5px;top: 8px;"
                    v-if="contact.unread_count">
                    <span class=" badge-success rounded px-2">{{contact.unread_count}}</span>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },

        data() {
            return {
                selectedId: this.contacts.length ? [...this.contacts].shift().id : null
            }
        },

        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [contact => {
                    // if (contact.id === this.selectedId) return Infinity;

                    return contact.unread_count;
                }]).reverse();
            }
        },

        methods: {
            contactSelected(contact) {
                this.selectedId = contact.id;
                this.$emit('selected', contact);
            }
        }
    }
</script>

<style scoped>
    .bg-selected {
        background-color: #cee6ff !important;
    }
</style>
