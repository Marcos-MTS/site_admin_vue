<template>
  <div class="content">
    <h3 class="form-titulo">Edição de notícias</h3>
    <Message ref="Message" />
    <form ref="form" @submit.prevent="submit" id="form-area">
      <div class="input-area">
        <label for="categorie_id">Categoria</label>
        <select v-model="formData.categorie_id" id="categorie_id" required>
          <option
            v-for="categorie in categories"
            :key="categorie.id"
            :value="categorie.id"
          >
            {{ categorie.name }}
          </option>
        </select>
      </div>
      <div class="input-area">
        <label for="title">Título</label>
        <input v-model="formData.title" type="text" id="title" required />
      </div>
      <div class="input-area">
        <label for="author">Autor</label>
        <input v-model="formData.author" type="text" id="author" required />
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
      categories: {},
    };
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  mounted() {
    this.$refs.Message.show("Carregando...", "loading");
    api
      .get("/news/" + this.id)
      .then((res) => {
        if (res.status === 200) {
          this.formData = res.data.data;
          this.loadCategories();
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
    loadCategories: function () {
      api
        .get("/categories")
        .then((res) => {
          this.$refs.Message.close(false);
          if (res.status === 200) {
            this.categories = res.data.data;
          } else {
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");
      api
        .put("/news/" + this.id, this.formData)
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
 