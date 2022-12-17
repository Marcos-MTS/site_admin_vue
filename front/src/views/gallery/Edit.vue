<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Galeria de imagens</h3>
    </div>
    <Message ref="Message" />

    <div class="input-area">
      <label for="image">Imagem</label>
      <div class="image-input-edit">
        <input
          type="file"
          ref="images"
          multiple
          id="images"
          @change="handleImages"
        />
        <ImageViewer :url="'uploads/news/' + formData.image" />
      </div>
    </div>

    <div class="input-area">
      <Button @click="submit" title="Adicionar fotos" type="save" />
    </div>
  </div>
</template>

<script>
import Button from "../../components/Button.vue";
import Message from "../../components/Message.vue";
import ImageViewer from "../../components/ImageViewer.vue";
import api from "../../services/api.js";

export default {
  name: "Edit",
  components: {
    Button,
    Message,
    ImageViewer,
  },
  data() {
    return {
      formData: {},
      images: null,
      categories: {},
    };
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  /*  mounted() {
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
        if (error.response.status == 401) {
          this.$router.push({ path: "/login" });
        } else {
          this.$refs.Message.show("Erro na conexão!", "error");
          console.log(error.response.data.error);
        }
      });
  },
 */
  methods: {
    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");

      let formData = new FormData();

      //adicionamos os dados do formulario
     /*  for (let [key, val] of Object.entries(this.formData)) {
        formData.append(key, val);
      } */

      //adicionamos a imagem
      // if (this.image) {
      //   formData.append("new_image", this.image);
      // }

      // let formData = new FormData();

      if (this.images) {
        for (var i = 0; i < this.images.length; i++) {
          let file = this.images[i];
          formData.append("images[" + i + "]", file);
        }
      }

      //fingimos o metodo PUT pois o laravel tem problemas em receber dados multipart-form via PUT e devido a isso usamos metodo POST
      //formData.append("_method", "put");

      api
        .put("/gallery", formData)
        .then((res) => {
          if (res.status === 200) {
            this.$refs.Message.show("Editado com sucesso!", "success");
            this.$refs.image.value = null;
            this.formData.image = res.data.data.image;
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

    handleImages(e) {
      this.images = e.target.files;
 
      console.log(this.images);
    },
  },
};
</script>
 