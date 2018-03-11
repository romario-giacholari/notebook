<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <button v-if="adding == false" class="btn  btn-success add-button mr-auto mb-2" @click="adding = true"><i class="fa fa-comment-o" aria-hidden="true"></i></button>
            <button v-else class="btn btn-lg btn-danger add-button mr-auto mb-2"  @click="adding=false"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <new-conversation v-if="adding == true" :contact="this.contact" @created="add"></new-conversation>
        <div v-for="(conversation, index) in items" :key="conversation.id">
            <conversation 
            :conversation="conversation"
            @updated="update"
            @deleted="remove(index)"
            >
            </conversation>
        </div>
    </div>
</template>

<script>
import Conversation from "./Conversation.vue";
import NewConversation from "./NewConversation.vue";
    export default {

        components: {Conversation, NewConversation},

        props: [ 'contact'],

        data() {
            return {
                items: this.contact.conversations,
                adding: false
            }
        },

        methods: {
             add(conversation) {
                this.items.unshift(conversation);
                this.adding = false;
            },
             remove(index) {
                this.items.splice(index, 1);
            },

            update() {
                axios.get('/contacts/' + this.contact.id + '/conversations')
                     .then(({data}) => {
                         this.items = data;
                     });
            }
        }

    }
</script>
