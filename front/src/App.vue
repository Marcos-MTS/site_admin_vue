<template>
 
  <Topo msg="Welcome to Your Vue.js App"/>
</template>

<script>
import Topo from './components/Topo.vue'

export default {
  name: 'App',
  components: {
    Topo
  }
}
</script>

<style>

*{
  padding: 0;
  margin: 0;

}

#app {
  font-family: "Poppins", sans-serif;
  color: #2c3e50;
}
</style>
