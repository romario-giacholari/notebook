<template>
    <div class="input-group mb-3">
         <input @keyup.enter="addTodo" v-model="newTodo" type="text" class="form-control" placeholder="todos.." aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="button" @click="addTodo">add todo</button>
        </div>
    </div>
</template>

<script>
    export default {
    data() {
        return { 
            newTodo: ''
        }
    },

    methods: {
        addTodo() {
            axios.post('/todos', { body: this.newTodo })
                .catch(error => {
                      flash(error.response.data.errors.body[0],'danger');
                })
                .then(({data}) => {
                    this.newTodo = '';
                    this.$emit('created', data);
                    flash('added.');
                });
        }
    }

}
</script>