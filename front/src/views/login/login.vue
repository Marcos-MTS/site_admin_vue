<template>
  <div class="content login">
    <div class="content-header">
      <h3 class="form-titulo">Login {{ $store.state.token }}</h3>
    </div>
    <Message ref="Message" />
    <form ref="form" @submit.prevent="submit" id="form-area">
      <div class="input-area">
        <label for="email">Email</label>
        <input v-model="formData.email" type="email" id="email" required />
      </div>
      <div class="input-area">
        <label for="password">Senha</label>
        <input
          v-model="formData.password"
          type="password"
          id="password"
          required
        />
      </div>
      <div class="input-area">
        <Button title="Login" type="login" />
      </div>
    </form>
  </div>
</template>

<script>
import Button from "../../components/Button.vue";
import Message from "../../components/Message.vue";
import api from "../../services/api.js";
//import store from "../../store/store.js";

export default {
  name: "Login",
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
      api.post("/login", this.formData)
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data.access_token);

            this.$store.dispatch("retrieveToken", {
              access_token: res.data.access_token,
            });

            this.$refs.Message.show("Login efetuado!", "success");
          } else {
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          if (error.response.status == 401) {
            this.formData.password = "";
            this.$refs.Message.show("Dados inválidos!", "error");
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },
  },
};
</script>
 