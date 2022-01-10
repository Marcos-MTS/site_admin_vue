<template>
  <div class="topo">
    <div
      v-on:click="abreMenu"
      class="menu-ativador"
      v-bind:class="{ aberto: menuAberto }"
    >
      <span class="linha l1"></span>
      <span class="linha l2"></span>
      <span class="linha l3"></span>
    </div>

    <nav class="menu" v-bind:class="{ aberto: menuAberto }">
      <ul>
        <li v-on:click="abreMenu"><router-link to="/">Dashboard</router-link></li>
        <li class="tem-sub-itens">
          Notícias
          <div v-on:click="abreMenu" class="sub-itens">
            <router-link to="/news-list" class="sub-item">Listar</router-link>
            <router-link to="/news-create" class="sub-item"
              >Cadastrar</router-link
            >
          </div>
        </li>
        <li v-on:click="abreMenu">Sobre</li>
        <li v-on:click="abreMenu">Galeria</li>
      </ul>
    </nav>

    <h1>{{ msg }}</h1>
    <div class="usuario">
      <img alt="Vue logo" src="../assets/logo.png" />
    </div>
  </div>
</template>

<script>
export default {
  name: "Topo",
  props: {
    msg: String,
  },
  data() {
    return { menuAberto: false };
  },
  methods: {
    abreMenu() {
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
.menu-ativador {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.menu-ativador .linha {
  width: 45px;
  height: 4px;
  background: rgb(255, 255, 255);
  transition: 0.5s;
}

.menu-ativador.aberto .linha.l2 {
  display: none;
}

.menu-ativador.aberto .linha.l1 {
  transform: rotate(320deg);
  position: relative;
  top: 6px;
}
.menu-ativador.aberto .linha.l3 {
  transform: rotate(45deg);
  top: -6px;
  position: relative;
}

.topo {
  height: 60px;
  width: 100%;
  background: #6075c3;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-left: 15px;
  padding-right: 15px;
  box-sizing: border-box;
}

.topo h1 {
  color: #ffffff;
  font-size: 24px;
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
  background: #7b92e9;
  left: -100%;
  top: 60px;
  height: calc(100vh - 60px);
  width: 300px;
  padding: 10px 20px;
  box-sizing: border-box;
  transition: 0.5s;
}

.menu.aberto {
  left: 0;
}

.menu ul li,
.menu ul a {
  color: #ffffff;
  padding: 5px 5px;
  list-style: none;
  font-size: 18px;
}

.menu ul li:hover {
  background: #8ca1f0;
  cursor: pointer;
}
.tem-sub-itens .sub-itens {
  margin-left: 15px;
  padding: 5px 0;
  display: flex;
    flex-direction: column;
}
</style>
