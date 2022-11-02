<template>
  <div class="content">
    <div class="content-header">
      <h3 class="form-titulo">Lista de Usuários</h3>
      <router-link to="users-create"
        ><Button title="Adicionar" type="new" class="right"
      /></router-link>
    </div>

    <div class="search">
      <div class="input-area">
        <label for="search">Pesquisar</label>
        <input v-model="search" type="text" id="search" required />
      </div>
      <Button
        title="Pesquisar"
        @click="loadData()"
        type="search"
        class="right"
      />
    </div>

    <Message ref="Message" />
    <table class="list-table">
      <tr>
        <th class="left-text">Nome</th>
        <th class="left-text">Email</th>
       <th class="left-text">Perfil</th> 
        <th class="center-text">Imagem</th>
        <th class="right-text">Opções</th>
      </tr>
      <tr v-for="item in listData.data" :key="item.id">
        <td class="left-text">{{ item.name }}</td>
        <td class="left-text">{{ item.email }}</td>
     <td class="left-text">
          {{ item.users_level != null ? item.users_level.name : "" }}
        </td>
        <td class="left-text">
          <ImageViewer :url="'uploads/users/' + item.image" />
        </td>
        <td class="options">
          <router-link
            v-bind:to="{ name: 'UsersEdit', params: { id: item.id } }"
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
import ImageViewer from "../../components/ImageViewer.vue";
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
    ImageViewer,
  },
  data() {
    return {
      search: "",
      listData: [],
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
        .get("/users?page=" + page + "&search=" + this.search)
        .then((res) => {
          this.$refs.Message.close(false);
          if (res.status === 200) {
            this.listData = res.data;
            this.paginationData.links = res.data.links;
            this.paginationData.total = res.data.meta.last_page;
            this.paginationData.active = parseInt(page);
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

    remove: function (id) {
      this.$refs.Message.show("Aguarde", "loading");

      api
        .delete("/users/" + id)
        .then((res) => {
          if (res.status === 200) {
            this.listData.data = this.listData.data.filter(function (event) {
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
 