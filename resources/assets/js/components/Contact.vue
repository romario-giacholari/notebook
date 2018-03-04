<template>
    <div class="thumbnail">
        <a :href="path"
             data-toggle="popover" 
             data-trigger="hover" 
            :data-content="email">

            <img :src="avatar" style="width:100%">
        </a>
        <div class="caption" v-text="name"></div>
    </div>
</template>

<script>
    export default {

      props : ["contact"],

      data () {
          return {
              path: this.contact.path,
              avatar: this.contact.avatar,
              name: this.contact.name,
              gender: this.contact.gender,
              email: this.contact.email
          }
      },
    }
</script>
