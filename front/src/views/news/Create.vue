<template>
  <div class="content">
    <h3 class="form-titulo">Cadastro de notícias</h3>
    <form ref="form" @submit.prevent="submit">
      <div class="input-area">
        <label for="titulo">Título</label>
        <input
          v-model="titulo"
          type="text"
          name="titulo"
          id="titulo"
          required
        />
      </div>
      <div class="input-area">
        <label for="autor">Autor</label>
        <input v-model="autor" type="text" name="autor" id="autor" />
      </div>
      <div class="input-area">
        <Button title="Salvar" type="save" />
      </div>
    </form>
  </div>
</template>

<script>
import Button from "../../components/Button.vue";

export default {
  name: "Create",
  components: {
    Button,
  },
  data() {
    return {
      titulo: "",
      autor: "",
    };
  },
  methods: {
    cadastrar() {
      alert(this.titulo);
    },

    submit: function () {
      const formData = new FormData(this.$refs["form"]); // reference to form element
      const data = {}; // need to convert it before using not with XMLHttpRequest
      for (let [key, val] of formData.entries()) {
        Object.assign(data, { [key]: val });
      }

      console.log(data);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.input-area {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}

.input-area input {
  height: 28px;
  font-size: 1em;
  padding: 4px 8px;
  border: solid 1px #ddd;
  box-shadow: 0px 0px 2px #dfdfdf;
}

.input-area label {
  font-size: 1em;
  font-weight: 500;
}

.form-titulo {
  font-size: 20px;
  margin-bottom: 15px;
}

.content {
  padding: 25px 25px;
  box-shadow: 1px 0px 10px #ebebeb;
}
</style>
