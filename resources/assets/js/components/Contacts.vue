<template>
    <div class="row">
        <div v-for="(contact) in items" :key="contact.id" class="col-md-2">
            <contact :contact="contact"></contact>
        </div>
    </div>
</template>

<script>
import Contact from "./Contact.vue";

    export default {
    components: { Contact },

    props: ['contacts'],

    data() {
        return { 
            items: this.contacts,
        }
    }

}
</script>
