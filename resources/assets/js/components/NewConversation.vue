<template>
    <div class="row">
        <div class="col-md-12">
            <h2><strong>Log conversation.</strong></h2>
                <dl class="row conversation-item p-2">
                    <dt class="col-sm-3">Topic</dt>
                    <dd class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="topic" v-model="newTopic">
                        </div>
                    </dd>

                    <dt class="col-sm-3">What did you talk about?</dt>
                    <dd class="col-sm-9">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="What did you talk about?" v-model="newBody"></textarea>
                        </div>
                    </dd>

                    <button class="btn btn-primary" @click="add">Add</button>
                </dl>
        </div>
    </div>
</template>

<script>
export default {
        
    props:['contact'],

    data() {
        return {
            newTopic: '',
            newBody: '',
        }
    },

    methods: {
        add() {
            axios.post('/contacts/' + this.contact.id + '/conversations', {
                topic: this.newTopic,
                body: this.newBody

                })
                 .catch(error => {
                      flash(error.response.data.message,'danger');
                })
                .then(({data}) => {
                   
                    this.newTopic = '';
                    this.newBody = '';
                    this.$emit('created', data);
                    flash('added.');
                });
        }
    }
}
</script>