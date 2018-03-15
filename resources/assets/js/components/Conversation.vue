<template>
    <div class="mt-2">
        <div v-if="editing" class="conversation-item p-2">
            <dl class="row">
                <dt class="col-sm-3">Topic</dt>
                <dd class="col-sm-9">
                    <input type="text" v-model="topic">
                </dd>

                <dt class="col-sm-3">What did you talk about?</dt>
                <dd class="col-sm-9"> 
                    <textarea v-model="body"></textarea>
                </dd>

                <button class="btn btn-primary btn-sm ml-3" @click="update">update</button>
                <button class="btn btn-secondary btn-sm ml-1" @click="cancel">cancel</button>
            </dl>
        </div>

        <div v-else class="conversation-item p-2">
            <dl class="row">
                <dt class="col-sm-3">Topic</dt>
                <dd class="col-sm-9" v-text="topic"></dd>

                <dt class="col-sm-3">What did you talk about?</dt>
                <dd class="col-sm-9">
                    <p v-text="body"></p>
                </dd>

                <button class="btn btn-secodary btn-sm ml-3" @click="editing = true">edit</button>
                <button class="btn btn-danger btn-sm ml-1" @click="remove">delete</button>
            </dl>
        </div>

    </div>
</template>

<script>
     export default {
         
        props: ['conversation'],

        data() {
            return {
                topic: this.conversation.topic,
                body: this.conversation.body,
                id: this.conversation.id,
                editing: false,
            }
        },

        methods: {
            cancel() {
                this.editing = false;
                
                this.topic = this.conversation.topic;
                this.body = this.conversation.body;
            },

            remove() {
                axios.delete('/contacts/' + this.conversation.contact_id + '/conversations/' + this.id)
                    .catch(error => {
                        flash(error.response.data.errors.body[0],'danger');

                    })
                    .then(({data}) => {
                        this.$emit('deleted', this.id)

                        flash('deleted!');
                });
            },

            update() {
                axios.patch('/contacts/' + this.conversation.contact_id + '/conversations/' + this.id, {
                    topic: this.topic,
                    body: this.body
                    })
                    .catch(error => {
                            flash(error.response.data.errors.body[0],'danger');
                    })
                    .then(({data}) => {
                            this.editing = false;

                            this.$emit('updated');
                            
                            flash('updated!');
                    });
            }
        }

    }
</script>
<style>
.conversation-item {
    background-color: #f4f8fc;
    font-family:Comic Sans MS;
}
</style>