<template>
    <div>
        <ul v-if="editing" class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <input @keyup.enter="update" v-model="body" type="text" class="form-control mr-auto">
                <button class="btn btn-success ml-1" @click="update">update</button>
                <button class="btn btn-secondary ml-1" @click="cancel">cancel</button>
            </li>
        </ul>
        <ul v-else class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="mr-auto font-weight-bold" v-text="body" @click="editing=true"></div>
                <button class="btn btn-outline-success" @click="complete"><i class="fa fa-check" aria-hidden="true"></i></button>
                <button class="btn btn-outline-danger ml-1" @click="remove"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <button class="btn btn-outline-info ml-1" @click="editing = true"><i class="fa fa-edit" aria-hidden="true"></i></button>
            </li>
        </ul>
    </div>
    
</template>

<script>
    export default {

      props : ["todo"],

    data () {
          return {
              body: this.todo.body,
              id: this.todo.id,
              completed: false,
              editing: false,
          }
      },

      methods: {
          complete() {
              axios.patch('/todos/'+ this.id, {completed: true, body:this.body})
                    .catch(error => {
                        console.log(error);
                            flash(error.response.data.errors.body[0],'danger');

                    })
                    .then(({data}) => {
                        this.$emit('completed', this.id)
                        
                        flash('completed!');
                });
     
          },

          remove() {
              axios.delete('/todos/'+ this.id)
                    .catch(error => {
                        flash(error.response.data.errors.body[0],'danger');

                    })
                    .then(({data}) => {
                        this.$emit('deleted', this.id)

                        flash('deleted!');
                });
         
          },

          update() {
              axios.patch('/todos/'+ this.id, {completed: this.completed, body: this.body})
                    .catch(error => {
                            flash(error.response.data.errors.body[0],'danger');
                        })
                        .then(({data}) => {
                            this.editing = false;

                            this.$emit('updated');
                            
                            flash('updated!');
                        });
          },

          cancel() {
              this.editing = false;

              this.body = this.todo.body;
          }
      }
    }
</script>
