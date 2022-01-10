<template>
 <button v-bind:class="type" v-bind:title="title">{{this.title}}</button>
</template>

<script>
export default {
  name: 'Button',
  props:{
      title: String,
      type:  String
  }
}
</script>

<style scoped>

button{
 
 height: 35px;
 width: 70px;
 color: #ffffff;
 border: none;
 }

 button.save{
background: green;
 }

</style>
