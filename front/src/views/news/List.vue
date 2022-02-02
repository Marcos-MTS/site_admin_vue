<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Lista de Notícias</h3>
      <router-link to="news-create"
        ><Button title="Adicionar" type="new" class="right"
      /></router-link>
    </div>
    <Message ref="Message" />
    <table class="list-table">
      <tr>
        <th class="left-text">Título</th>
        <th class="left-text">Autor</th>
        <th class="right-text">Opções</th>
      </tr>
      <tr v-for="item in formData.data" :key="item.id">
        <td class="left-text">{{ item.title }}</td>
        <td class="left-text">{{ item.author }}</td>
        <td class="options">
          <router-link
            v-bind:to="{ name: 'NewsEdit', params: { id: item.id } }"
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

    <Pagination
      @loadData="loadData"
      :links="this.paginationData.links"
      :total="this.paginationData.total"
      :active="this.paginationData.active"
    />
  </div>
</template>

<script>
import api from "../../services/api.js";
import Message from "../../components/Message.vue";
import Button from "../../components/Button.vue";
import Pagination from "../../components/Pagination.vue";
import { Icon } from "@iconify/vue";

export default {
  name: "List",
  components: {
    Icon,
    Message,
    Button,
    Pagination,
  },
  data() {
    return {
      formData: [],
      paginationData: [],
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData: function (page = 1) {
      this.$refs.Message.show("Carregando...", "loading");
      api
        .get("/news?page=" + page)
        .then((res) => {
          this.$refs.Message.close(false);
          if (res.status === 200) {
            this.formData = res.data;
            this.paginationData.links = res.data.links;
            this.paginationData.total = res.data.meta.last_page;
            this.paginationData.active = parseInt(page);
          } else {
            console.log(res.statusText);
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    remove: function (id) {
      this.$refs.Message.show("Aguarde", "loading");

      api
        .delete("/news/" + id)
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
 