<template>
  <div class="content">
    <h3 class="form-titulo">Meus dados de usuário</h3>
    <Message ref="Message" />
    <form ref="form" @submit.prevent="submit" id="form-area">
      <div class="input-area">
        <label for="users_levels_id">Perfil</label>
        <select
          v-model="formData.users_levels_id"
          id="users_levels_id"
          required
        >
          <option
            v-for="users_level in users_levels"
            :key="users_level.id"
            :value="users_level.id"
          >
            {{ users_level.name }}
          </option>
        </select>
      </div>

      <div class="input-area">
        <label for="name">Nome</label>
        <input v-model="formData.name" type="text" id="name" required />
      </div>

      <div class="input-area">
        <label for="email">Email</label>
        <input v-model="formData.email" type="email" id="email" required />
      </div>

      <div class="input-area">
        <label for="password">Nova senha</label>
        <input v-model="formData.password" type="password" id="password" />
      </div>

      <div class="input-area">
        <label for="image">Imagem</label>
        <div class="image-input-edit">
          <input type="file" ref="image" id="image" @change="handleImage" />
          <ImageViewer :url="'uploads/users/' + formData.image" />
        </div>
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
import ImageViewer from "../../components/ImageViewer.vue";
import api from "../../services/api.js";

export default {
  name: "MyUser",
  components: {
    Button,
    Message,
    ImageViewer,
  },
  data() {
    return {
      formData: {},
      image: null,
      users_levels: {},
    };
  },

  mounted() {
    this.$refs.Message.show("Carregando...", "loading");
    api
      .get("/my_user")
      .then((res) => {
        if (res.status === 200) {
          this.formData = res.data.data;
          this.loadUsersLevels();
        } else {
          console.log(res.statusText);
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

  methods: {
    loadUsersLevels: function () {
      api
        .get("/users_level")
        .then((res) => {
          this.$refs.Message.close(false);
          if (res.status === 200) {
            this.users_levels = res.data.data;
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
      if (this.image) {
        formData.append("new_image", this.image);
      }

      //fingimos o metodo PUT pois o laravel tem problemas em receber dados multipart-form via PUT e devido a isso usamos metodo POST
      formData.append("_method", "put");

      api
        .post("/my_user", formData)
        .then((res) => {
          if (res.status === 200) {
            this.$refs.Message.show("Editado com sucesso!", "success");
            this.$refs.image.value = null;
            this.formData.image = res.data.data.image;

            this.$store.dispatch("retrieveUser", {
              access_token: false,
              user_level: res.data.data.users_levels_id,
              user_name: res.data.data.name,
              user_image: res.data.data.image,
            });

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
 