<template>
  <div class="topo">
 
    <Icon
      :icon="!menuAberto ? 'eva:menu-fill': 'fe:close'"
      v-on:click="toggleMenu"
      class="menu-icon"
      width="40"
    />
    
    <nav class="menu" v-bind:class="{ aberto: menuAberto }">
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
          title="Usuários"
          :items="[
            { title: 'Cadastrar', to: '/users-create' },
            { title: 'Listar', to: '/users-list' },
          ]"
        />

         <MenuDropdown
          title="Perfis de Usuários"
          :items="[
            { title: 'Cadastrar', to: '/users-level-create' },
            { title: 'Listar', to: '/users-level-list' },
          ]"
        />

        <li v-on:click="toggleMenu">Sobre</li>
        <li v-on:click="toggleMenu">Galeria</li>
      </ul>
    </nav>

    <h1>{{ title }}</h1>
    <div class="usuario">
      <img alt="Vue logo" src="../assets/logo.png" />
    </div>
  </div>
</template>

<script>
import MenuDropdown from "./MenuDropdown.vue";
import { Icon } from "@iconify/vue";

export default {
  name: "Topo",
  components: {
    MenuDropdown,
    Icon,
  },
  props: {
    title: String,
  },
  data() {
    return { menuAberto: false };
  },
  methods: {
    toggleMenu() {
      if (this.menuAberto) {
        this.menuAberto = false;
      } else {
        this.menuAberto = true;
      }
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.menu-icon {
  color: #ffffff;
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
}

.topo .usuario img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  -o-object-fit: cover;
  object-fit: cover;
  background: #ffffff;
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

.menu.aberto {
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
