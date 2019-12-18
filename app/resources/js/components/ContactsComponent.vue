<template>
    <ul class="list-group">
        <li :class="`list-group-item
                    list-group-item-light
                    list-group-item-action
                    ${selectedId == contact.id && 'bg-selected'}`"
            style="cursor: pointer"
            v-for="(contact, index) in contacts"
            :key="contact.id"
            @click="contactSelected(index, contact)">
            <div class="row">
                <div class="avatar col-3">
                    <img
                        :src="contact.profile_image"
                        width="50"
                        class="img-fluid rounded-circle"
                        :alt="contact.name">
                </div>
                <div class="col-9">
                    <div class="name text-dark strong" v-text="contact.email"></div>
                    <div class="name text-secondary strong" v-text="contact.name"></div>
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
                selectedId: 0
            }
        },

        methods: {
            contactSelected(index, contact) {
                this.selectedId = contact.id;
                this.$emit('selected', {index, contact});
            }
        }
    }
</script>

<style scoped>
    .bg-selected {
        background-color: #cee6ff !important;
    }
</style>
