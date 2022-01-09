<template>
  <div class="conteudo">
    <h3 class="form-titulo">Cadastro de notícias</h3>
    <div class="input-area">
        <label for="titulo">Título</label>
      <input type="text" name="titulo" id="titulo">
    </div>
    <div class="input-area">
        <label for="autor">Autor</label>
      <input type="text" name="autor" id="autor">
    </div>
  </div>
</template>

<script>
export default {
  name: "Cadastro",

  data() {
    return {};
  },
  methods: {
    cadastrar() {},
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.input-area{
  display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.input-area input{
  height: 28px;
    font-size: 1em;
    padding: 0 8px;
}

.input-area label{
  font-size: 1em;
    font-weight: 500;
}

.form-titulo{
      font-size: 20px;
    margin-bottom: 15px;
}

.conteudo{
      padding: 25px 25px;
}

</style>
