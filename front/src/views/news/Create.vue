<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Cadastro de Notícias</h3>
      <router-link to="/news-list"
        ><Button title="Voltar" type="go-back" class="right"
      /></router-link>
    </div>
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
        <label for="image">Imagem</label>
        <input
          type="file"
          ref="image"
          id="image"
          @change="handleImage"
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
      image: null,
      categories: {},
    };
  },

  mounted() {
    this.loadCategories();
  },

  methods: {
    loadCategories: function () {
      this.$refs.Message.show("Carregando...", "loading");
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
          if (error.response.status == 401) {
            this.$router.push({ path: "/login" });
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },

    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");

      let formData = new FormData();

      //adicionamos os dados do formulario
      for (let [key, val] of Object.entries(this.formData)) {
        formData.append(key, val);
      }

      //adicionamos a imagem
      formData.append("image", this.image);

      api
        .post("/news", formData)
        .then((res) => {
          if (res.status === 201) {
            this.formData.title = "";
            this.formData.author = "";
            this.$refs.Message.show("Cadastrado com sucesso!", "success");
          } else {
            console.log(res.statusText);
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          if (error.response.status == 401) {
            this.$router.push({ path: "/login" });
          } else if (error.response.status == 422) {
            this.$refs.Message.handleErrors(error.response.data.errors);
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },

    handleImage(e) {
      this.image = e.target.files[0];
    },
  },
};
</script>
 