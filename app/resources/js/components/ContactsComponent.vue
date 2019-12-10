<template>
    <ul class="list-group">
        <li class="list-group-item list-group-item-light list-group-item-action"
            style="cursor: pointer"
            v-for="contact in contacts"
            :key="contact.id">
            <div class="row">
                <div class="avatar col-3">
                    <img :src="contact.profile_image" width="50" :alt="contact.name">
                </div>
                <div class="col-9">
                    <p class="name text-dark strong" v-text="contact.email"></p>
                    <p class="name text-secondary strong" v-text="contact.name"></p>
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
    }
</script>
