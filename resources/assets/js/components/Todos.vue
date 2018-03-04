<template>
<div>
    <add-todo @created="add"></add-todo>
    <div class="row">
        <div v-for="(todo, index) in items" :key="todo.id" class="col-md-12">
            <todo :todo="todo" @completed="complete(index)" @deleted="remove(index)"></todo>
            <hr />
        </div>
        <hr />
    </div>
</div>
</template>

<script>
import Todo from "./Todo.vue";
import AddTodo from "./AddTodo.vue";

    export default {
    components: { Todo , AddTodo},

    props: ['todos'],

    data() {
        return { 
            items: this.todos,
        }
    },

    methods: {
        add(todo) {
            this.items.unshift(todo);
        },

        complete(index) {
            var audio = new Audio('click.mp3');
            audio.play();

            this.items.splice(index, 1);
        },

        remove(index) {
            this.items.splice(index, 1);
        }
    }

}
</script>