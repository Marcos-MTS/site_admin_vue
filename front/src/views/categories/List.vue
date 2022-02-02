<template>
  <div class="content">
   <div class="content-header">
      <h3 class="form-titulo">Lista de Categorias</h3>
      <router-link to="categories-create"
        ><Button title="Adicionar" type="new" class="right"
      /></router-link>
    </div>
    <Message ref="Message" />
    <table class="list-table">
      <tr>
        <th class="left-text">Nome</th>
        <th class="right-text">Opções</th>
      </tr>
      <tr v-for="item in formData.data" :key="item.id">
        <td class="left-text">{{ item.name }}</td>
        <td class="options">
          <router-link
            v-bind:to="{ name: 'CategoriesEdit', params: { id: item.id } }"
            title="Editar"
            ><Icon icon="clarity:edit-solid" color="#6075c3" width="25"
          /></router-link>
          <div @click="remove(item.id)" title="Excluir">
            <Icon
              icon="fluent:delete-dismiss-24-filled"
              color="#e50202"
              width="25"
            />
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import api from "../../services/api.js";
import Message from "../../components/Message.vue";
import Button from "../../components/Button.vue";
import { Icon } from "@iconify/vue";

export default {
  name: "Create",
  components: {
    Icon,
    Message,
    Button
  },
  data() {
    return {
      formData: [],
    };
  },
  mounted() {
    this.$refs.Message.show("Carregando...", "loading");
    api
      .get("/categories")
      .then((res) => {
        this.$refs.Message.close(false);
        if (res.status === 200) {
          this.formData = res.data;
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
    remove: function (id) {
      this.$refs.Message.show("Aguarde", "loading");

      api
        .delete("/categories/" + id)
        .then((res) => {
          if (res.status === 200) {
            this.formData.data = this.formData.data.filter(function (event) {
              return event.id !== id;
            });

            this.$refs.Message.show("Removido com sucesso!", "success");
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
 