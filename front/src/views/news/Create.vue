<template>
  <div class="content">
    <h3 class="form-titulo">Cadastro de notícias</h3>
    <form ref="form" @submit.prevent="submit" id="form-area">
      <Message ref="Message" />
      <div class="input-area">
        <label for="titulo">Título</label>
        <input
          v-model="form.title"
          type="text"
          name="titulo"
          id="titulo"
          required
        />
      </div>
      <div class="input-area">
        <label for="autor">Autor</label>
        <input
          v-model="form.author"
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
  name: "Create",
  components: {
    Button,
    Message,
  },
  data() {
    return {
      form: {
        title: "",
        author: "",
      },
    };
  },

  methods: {
    submit: function () {
      this.$refs.Message.show("Aguarde", "loading");

      api
        .post("/news", this.form)
        .then((res) => {
          if (res.status == 201) {
            this.form.title = "";
            this.form.author = "";
            this.$refs.Message.show("Cadastrado com sucesso!", "success");
          } else {
            alert(res.statusText);
          }
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          //Perform action in always
        });
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
