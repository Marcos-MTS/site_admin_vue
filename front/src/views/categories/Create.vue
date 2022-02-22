<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Cadastro de Categorias</h3>
      <router-link to="categories-list"><Button title="Voltar" type="go-back" class="right"/></router-link>
    </div>
    <Message ref="Message" />
    <form ref="form" @submit.prevent="submit" id="form-area">
      <div class="input-area">
        <label for="name">Nome</label>
        <input
          v-model="formData.name"
          type="text"
          id="name"
          required
        />
      </div>
      <div class="input-area">
        <label for="description">Descrição</label>
        <input
          v-model="formData.description"
          type="text"
          id="description"
          required
        />
      </div>
      <div class="input-area">
        <Button title="Salvar" type="save" />
      </div>
    </form>
  </div>
</template>

<script>
import Button from "../../components/Button.vue";
import Message from "../../components/Message.vue";
import api from "../../services/api.js";

export default {
  name: "Create",
  components: {
    Button,
    Message,
  },
  data() {
    return {
      formData: {},
    };
  },

  methods: {
    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");
      api
        .post("/categories", this.formData)
        .then((res) => {
          if (res.status === 201) {
            this.formData.name = "";
            this.formData.description = "";
            this.$refs.Message.show("Cadastrado com sucesso!", "success");
          } else {
            console.log(res.statusText);
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
 