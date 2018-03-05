<template>

    <dl class="row  journal-item p-2">
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
    </dl>
    
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
          }
      },

    //   methods: {
    //       complete() {
    //           axios.patch('/todos/'+ this.id, {completed: true, body:this.body})
    //                 .catch(error => {
    //                         flash(error.response.data.errors.body[0],'danger');

    //                 })
    //                 .then(({data}) => {
    //                     this.$emit('completed', this.id)
                        
    //                     flash('completed!');
    //             });
     
    //       },

    //       remove() {
    //           axios.delete('/todos/'+ this.id)
    //                 .catch(error => {
    //                     flash(error.response.data.errors.body[0],'danger');

    //                 })
    //                 .then(({data}) => {
    //                     this.$emit('deleted', this.id)

    //                     flash('deleted!');
    //             });
         
    //       },

    //       update() {
    //           axios.patch('/todos/'+ this.id, {completed: this.completed, body: this.body})
    //                 .catch(error => {
    //                         flash(error.response.data.errors.body[0],'danger');
    //                     })
    //                     .then(({data}) => {
    //                         this.editing = false;

    //                         flash('updated!');
    //                     });
    //       },

    //       cancel() {
    //           this.editing = false;

    //           this.body = this.todo.body;
    //       }
    //   }
    }
</script>
<style>
.journal-item {
    background-color: #FFFF66;
    font-family:Comic Sans MS;
}
</style>