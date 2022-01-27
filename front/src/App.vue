<template>
  <Topo msg="Painel de Controle" />

  <div class="centro">
   <router-view/>
  </div>
  <Rodape />
</template>

<script>
import Topo from "./components/Topo.vue";
import Rodape from "./components/Rodape.vue";


export default {
  name: "App",
  components: {
    Topo,
    Rodape,
  },
};
</script>

<style>
* {
  padding: 0;
  margin: 0;
}

a{
  text-decoration: none;
}

.centro{
  max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    width: 90%;
    border: solid 1px #ddd;
    margin-top: 20px;
}
#app {
  font-family: "Poppins", sans-serif;
  color: #2c3e50;
}


.center-text{
  text-align: center;
}

.right-text{
  text-align: right;
}

.left-text{
  text-align: left;
}


</style>
