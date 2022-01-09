<template>
  <Topo msg="Painel de Controle" />
  <div class="centro">
    <NoticiasCadastro />
  </div>
  <Rodape />
</template>

<script>
import Topo from "./components/Topo.vue";
import Rodape from "./components/Rodape.vue";

//noticias
import NoticiasCadastro from "./components/noticias/Cadastro.vue";

export default {
  name: "App",
  components: {
    Topo,
    Rodape,
    NoticiasCadastro,
  },
};
</script>

<style>
* {
  padding: 0;
  margin: 0;
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
</style>
