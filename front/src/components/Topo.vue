<template>
  <div class="topo">
    <Icon
      :icon="!menuOpen ? 'eva:menu-fill' : 'fe:close'"
      v-on:click="toggleMenu"
      class="menu-icon"
      width="40"
      v-if="$store.getters.loggedIn"
    />

    <nav class="menu" v-bind:class="{ open: menuOpen }">
      <ul>
        <li v-on:click="toggleMenu">
          <router-link to="/">Dashboard</router-link>
        </li>

        <MenuDropdown
          title="Notícias"
          :items="[
            { title: 'Cadastrar', to: '/news-create' },
            { title: 'Listar', to: '/news-list' },
          ]"
        />

        <MenuDropdown
          title="Categorias"
          :items="[
            { title: 'Cadastrar', to: '/categories-create' },
            { title: 'Listar', to: '/categories-list' },
          ]"
        />

        <MenuDropdown
          v-show="$store.state.user.level == 1"
          title="Usuários"
          :items="[
            { title: 'Cadastrar', to: '/users-create' },
            { title: 'Listar', to: '/users-list' },
          ]"
        />

        <MenuDropdown
          v-show="$store.state.user.level == 1"
          title="Perfis de Usuários"
          :items="[
            { title: 'Cadastrar', to: '/users-level-create' },
            { title: 'Listar', to: '/users-level-list' },
          ]"
        />

        <li v-on:click="toggleMenu">Sobre</li>
         
        <li v-on:click="toggleMenu"><router-link to="/gallery">Galeria</router-link></li>
         
      </ul>
    </nav>

    <h1>{{ title }}</h1>
    <div class="usuario" v-if="$store.getters.loggedIn">
      <span> {{ $store.state.user.name ? $store.state.user.name : "" }} </span>
      <Icon
        class="user-icon"
        width="30"
        :icon="
          !userMenuOpen
            ? 'material-symbols:keyboard-arrow-down'
            : 'material-symbols:keyboard-arrow-up'
        "
        v-on:click="toggleUserMenu"
      />
      <img
        alt="Vue logo"
        :src="apiUrl + '/uploads/users/' + $store.state.user.image"
      />

      <nav class="user-menu" v-bind:class="{ open: userMenuOpen }">
        <ul>
          <li v-on:click="toggleUserMenu">
            <router-link to="/">
              <Icon width="20" icon="grommet-icons:configure" />
              Configurações
            </router-link>
          </li>

          <li v-on:click="toggleUserMenu">
            <router-link to="/my-user/">
              <Icon width="20" icon="cil:user" />
              Meus dados
            </router-link>
          </li>

          <li>
            <router-link v-on:click="logout" to="/login">
              <Icon width="20" icon="material-symbols:logout" />
              Sair
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
    <Message ref="Message" />
  </div>
</template>

<script>
import MenuDropdown from "./MenuDropdown.vue";
import { Icon } from "@iconify/vue";
import Message from "./Message.vue";
import api from "../services/api.js";

export default {
  name: "Topo",
  components: {
    MenuDropdown,
    Icon,
    Message,
  },
  props: {
    title: String,
  },
  data() {
    return {
      menuOpen: false,
      userMenuOpen: false,
      apiUrl: process.env.VUE_APP_API_URL,
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
    toggleUserMenu() {
      this.userMenuOpen = !this.userMenuOpen;
    },
    logout() {
      this.$refs.Message.show("Aguarde...", "loading");
      api
        .get("/logout")
        .then((res) => {
          if (res.status === 200) {
            this.$store.dispatch("logout");
            this.userMenuOpen = false;
            this.menuOpen = false;
            this.$refs.Message.show("Logout efetuado!", "success");
          } else {
            console.log(res.statusText);
            this.$refs.Message.show("Ocorreu algum erro no servidor!", "error");
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.$refs.Message.handleErrors(error.response.data.errors);
          } else {
            this.$refs.Message.show("Erro na conexão!", "error");
            console.log(error.response.data.error);
          }
        });
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.menu-icon,
.user-icon {
  color: #ffffff;
  cursor: pointer;
}

.topo {
  height: 60px;
  width: 100%;
  background: #004791;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-left: 15px;
  padding-right: 15px;
  box-sizing: border-box;
}

.topo h1 {
  color: #ffffff;
  font-size: 22px;
  font-weight: 300;
}

.topo .usuario {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  position: relative;
}

.topo .usuario img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  -o-object-fit: cover;
  object-fit: cover;
  background: #ffffff;
}

.topo .usuario span {
  color: #ffffff;
  font-size: 1em;
}

.user-menu {
  position: absolute;
  background: #0051a5;
  right: 0px;
  top: -300%;
  padding: 3px 5px;
  box-sizing: border-box;
  transition: 0.3s;
}

.user-menu.open {
  top: 50px;
}

.user-menu ul li,
.user-menu ul a {
  color: #ffffff;
  padding: 2px 5px;
  list-style: none;
  font-size: 16px;
  font-weight: 300;
  display: flex;
  align-items: center;
  gap: 5px;
}

.user-menu ul li:hover {
  background: #004791;
  cursor: pointer;
}

.menu {
  position: absolute;
  background: #0051a5;
  left: -100%;
  top: 60px;
  height: calc(100vh - 60px);
  width: 300px;
  padding: 10px 20px;
  box-sizing: border-box;
  transition: 0.3s;
}

.menu.open {
  left: 0;
}

.menu ul li,
.menu ul a {
  color: #ffffff;
  padding: 5px 5px;
  list-style: none;
  font-size: 16px;
  font-weight: 300;
}

.menu ul li:hover {
  background: #004791;
  cursor: pointer;
}
.tem-sub-itens .sub-itens {
  margin-left: 15px;
  padding: 5px 0;
  flex-direction: column;
  display: none;
}
</style>
