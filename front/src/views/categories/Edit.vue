<template>
  <div class="content">
    <h3 class="form-titulo">Edição de Categorias</h3>
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
  name: "Edit",
  components: {
    Button,
    Message,
  },
  data() {
    return {
      formData: {},
    };
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  mounted() {
    api
      .get("/categories/" + this.id)
      .then((res) => {
        if (res.status === 200) {
          this.formData = res.data.data;
        } else {
          console.log(res.statusText);
          this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
        }
      })
      .catch((error) => {
        if (error.response.status == 401) {
            this.$router.push({ path: "/login" })
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
      });
  },

  methods: {
    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");
      api
        .put("/categories/" + this.id, this.formData)
        .then((res) => {
          if (res.status === 200) {
            this.$refs.Message.show("Editado com sucesso!", "success");
          } else {
            console.log(res.statusText);
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          if (error.response.status == 401) {
            this.$router.push({ path: "/login" })
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },
  },
};
</script>
 