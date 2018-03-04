<template>
    <div>
        <ul v-if="editing" class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <input @keyup.enter="addTodo" v-model="body" type="text" class="form-control" aria-describedby="basic-addon2">
                <a href="#" class="btn btn-success" @click="update">update</a>
            </li>
        </ul>
        <ul v-else class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="mr-auto" v-text="body"></div>
                <a href="#" class="btn btn-outline-success" @click="complete"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a href="#" class="btn btn-outline-danger ml-1" @click="remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
              completed: this.todo.completed,
              editing: false,
          }
      },

      methods: {
          complete() {
              axios.patch('/todos/'+ this.id, {completed: true});
              flash('completed!');
              this.$emit('completed', this.id)
          },

          remove() {
              axios.delete('/todos/'+ this.id);
              flash('deleted!');
              this.$emit('deleted', this.id)
          }
      }
    }
</script>
