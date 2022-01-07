<template>
 
  <Topo msg="Welcome to Your Vue.js App"/>

  <Rodape />

</template>

<script>
import Topo from './components/Topo.vue'
import Rodape from './components/Rodape.vue'

export default {
  name: 'App',
  components: {
    Topo,
    Rodape
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
