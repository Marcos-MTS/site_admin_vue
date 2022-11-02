<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Cadastro de perfis de usuário</h3>
      <router-link to="users-level-list"><Button title="Voltar" type="go-back" class="right"/></router-link>
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
        .post("/users_level", this.formData)
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
          if (error.response.status == 401) {
            this.$router.push({ path: "/login" })
           } else if (error.response.status == 422) {
            this.$refs.Message.handleErrors(error.response.data.errors);
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },
  },
};
</script>
 