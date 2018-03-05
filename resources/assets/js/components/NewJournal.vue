<template>
    <div class="row">
        <div class="col-md-12">
            <h2><strong>New entry.</strong></h2>
            <dl class="row  journal-item p-2">
                <dt class="col-sm-3">Event</dt>
                <dd class="col-sm-9">
                    <input type="text" v-model="newEvent">
                </dd>

                <dt class="col-sm-3">What did I learn?</dt>
                <dd class="col-sm-9">
                    <textarea v-model="newLearned"></textarea>
                </dd>

                <dt class="col-sm-3">What went well?</dt>
                <dd class="col-sm-9">
                    <textarea v-model="newWell"></textarea>
                </dd>

                <dt class="col-sm-3">What could I have done better?</dt>
                <dd class="col-sm-9"> 
                    <textarea v-model="newBetter"></textarea>
                </dd>

                <dt class="col-sm-3">Implications</dt>
                <dd class="col-sm-9"> 
                    <textarea v-model="newImplications"></textarea>
                </dd>
                
                <button class="btn btn-primary" @click="add">add</button>
            </dl>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newEvent: '',
            newLearned: '',
            newBetter: '',
            newWell: '',
            newImplications: ''
        }
    },

    methods: {
        add() {
            axios.post('/journals', {
                event: this.newEvent,
                learned: this.newLearned,
                better: this.newBetter,
                well: this.newWell,
                implications: this.newImplications

                })
                 .catch(error => {
                      flash(error.response.data.message,'danger');
                })
                .then(({data}) => {
                    this.newEvent = '';
                    this.newLearned = '';
                    this.newBetter = '';
                    this.newWell = '';
                    this.newImplications = '';
                    this.$emit('created', data);
                    flash('added.');
                });
        
        }
    }
}
</script>

<style>
#new-journal {
    
}
</style>