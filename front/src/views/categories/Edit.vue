<template>
  <div class="content">
    <h3 class="form-titulo">Edição de Categorias</h3>
    <Message ref="Message" />
    <form ref="form" @submit.prevent="submit" id="form-area">
      <div class="input-area">
        <label for="titulo">Nome</label>
        <input
          v-model="formData.name"
          type="text"
          name="titulo"
          id="titulo"
          required
        />
      </div>
      <div class="input-area">
        <label for="autor">Descrição</label>
        <input
          v-model="formData.description"
          type="text"
          name="autor"
          id="autor"
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
        console.log(error);
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
          console.log(error);
        });
    },
  },
};
</script>
 