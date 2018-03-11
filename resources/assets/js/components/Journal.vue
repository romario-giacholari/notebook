<template>
<div>
    <dl v-if="editing" class="row  journal-item p-2">
        <dt class="col-sm-3">Event</dt>
        <dd class="col-sm-9">
            <input type="text" v-model="event">
        </dd>

        <dt class="col-sm-3">What did I learn?</dt>
        <dd class="col-sm-9">
            <textarea v-model="learned"></textarea>
        </dd>

        <dt class="col-sm-3">What went well?</dt>
        <dd class="col-sm-9">
            <textarea v-model="well"></textarea>
        </dd>

        <dt class="col-sm-3">What could I have done better?</dt>
        <dd class="col-sm-9"> 
            <textarea v-model="better"></textarea>
        </dd>

        <dt class="col-sm-3">Implications</dt>
        <dd class="col-sm-9"> 
            <textarea v-model="implications"></textarea>
        </dd>
        <button class="btn btn-primary mr-1" @click="update">update</button>
        <button class="btn btn-light" @click="cancel">cancel</button>
    </dl>

    <dl v-else class="row  journal-item p-2">
        <dt class="col-sm-3">Event</dt>
        <dd class="col-sm-9" v-text="event"></dd>

        <dt class="col-sm-3">What did I learn?</dt>
        <dd class="col-sm-9">
            <p v-text="learned"></p>
        </dd>

        <dt class="col-sm-3">What went well?</dt>
        <dd class="col-sm-9">
            <p v-text="well"></p>
        </dd>

        <dt class="col-sm-3">What could I have done better?</dt>
        <dd class="col-sm-9"> 
            <p v-text="better"></p>
        </dd>

        <dt class="col-sm-3">Implications</dt>
        <dd class="col-sm-9"> 
            <p v-text="implications"></p>
        </dd>

        <button class="btn btn-secodary" @click="editing = true">edit</button>
        <button class="btn btn-danger ml-1" @click="remove">delete</button>
    </dl>

 </div>   
</template>

<script>
    export default {

      props : ["journal"],

    data () {
          return {
              event: this.journal.event,
              learned: this.journal.learned,
              well: this.journal.well,
              better: this.journal.better,
              implications: this.journal.implications,
              id: this.journal.id,
              editing: false,
          }
      },

    methods: {
        cancel() {
            this.editing = false;
            
            this.event = this.journal.event;
            this.learned = this.journal.learned;
            this.well = this.journal.well;
            this.better = this.journal.better;
            this.implications = this.journal.implications;
        },

        remove() {
            axios.delete('/journals/'+ this.id)
                .catch(error => {
                    flash(error.response.data.errors.body[0],'danger');

                })
                .then(({data}) => {
                    this.$emit('deleted', this.id)

                    flash('deleted!');
            });
        },

          update() {
              axios.patch('/journals/'+ this.id, {
                  event: this.event, 
                  learned: this.learned,
                  well: this.well,
                  better: this.better,
                  implications: this.implications
                  })
                    .catch(error => {
                            flash(error.response.data.errors.body[0],'danger');
                    })
                    .then(({data}) => {
                            this.editing = false;

                            this.$emit('updated');
                            
                            flash('updated!');
                    });
          },

    }
   
    }
</script>
<style>
.journal-item {
    background-color: #FFFF66;
    font-family:Comic Sans MS;
}
</style>