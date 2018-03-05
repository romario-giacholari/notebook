<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
             <button id="journal-fixed-button" class="btn btn-lg btn-success mr-auto" @click="adding=true"><i class="fa fa-plus" aria-hidden="true"></i></button>
             <h1 class="mr-auto"><strong>Journal</strong></h1> 
        </div>
        <hr />
        <div class="row">
            <new-journal v-if="adding"></new-journal>
            <div v-for="(journal) in items" :key="journal.id" class="col-md-12">
                <journal :journal="journal"></journal>
                <hr />
            </div>
        </div>
    </div>
</template>

<script>
import Journal from "./Journal.vue";
import NewJournal from "./NewJournal.vue";
    export default {

        components: {Journal, NewJournal},

        props: ['journals'],

        data() {
            return {
                items: this.journals,
                adding:false
            }
        }
    }
</script>

<style>
#journal-fixed-button {
    border-radius:50%;
    box-shadow: 2px 2px 0 2px rgba(0, 0, 0, 0.2);
}
</style>