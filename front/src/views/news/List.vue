<template>
  <div class="content">
    <h3 class="form-titulo">Lista de notícias</h3>
    <Message ref="Message" />
    <table class="list-table">
      <tr>
        <th class="left-text">Título</th>
        <th class="left-text">Autor</th>
        <th class="right-text">Opções</th>
      </tr>
      <tr v-for="item in news.data" :key="item.id">
        <td class="left-text">{{ item.title }}</td>
        <td class="left-text">{{ item.author }}</td>
        <td class="options">
          <a title="Editar"
            ><Icon icon="clarity:edit-solid" color="#6075c3" width="25"
          /></a>
          <a title="Excluir"
            ><Icon
              icon="fluent:delete-dismiss-24-filled"
              color="#e50202"
              width="25"
          /></a>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import api from "../../services/api.js";
import Message from "../../components/Message.vue";
import { Icon } from "@iconify/vue";

export default {
  name: "Create",
  components: {
    Icon,
    Message,
  },
  data() {
    return {
      news: [],
    };
  },
  mounted() {
    this.getList();
  },
  methods: {
    getList: function () {
      this.$refs.Message.show("Carregando...", "loading");
      api
        .get("/news")
        .then((res) => {
          this.$refs.Message.close(false);
          if (res.status === 200) {
            this.news = res.data;
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.content {
  padding: 25px;
}

.list-table {
  width: 100%;
  margin-top: 20px;
  border-collapse: collapse;
  border-spacing: 0;
}

.list-table th {
  border-top: solid #ddd 1px;
  border-bottom: solid #ddd 1px;
  padding: 10px;
}
.list-table td {
  border-bottom: solid #ddd 1px;
  padding: 8px;
}

.list-table .options {
  display: flex;
  justify-content: flex-end;
  gap: 20px;
}

.list-table .options-title {
  max-width: 140px;
}
</style>
