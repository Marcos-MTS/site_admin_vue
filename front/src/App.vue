<template>
  <Topo title="Painel de Controle" />

  <div class="centro">
    <router-view />
  </div>
  <Rodape />
</template>

<script>
import Topo from "./components/Topo.vue";
import Rodape from "./components/Rodape.vue";

export default {
  name: "App",
  components: {
    Topo,
    Rodape,
  },
};
</script>

<style>
* {
  padding: 0;
  margin: 0;
}

a {
  text-decoration: none;
}

.centro {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
  width: 90%;
  margin-top: 20px;
}
#app {
  font-family: "Poppins", sans-serif;
  color: #2c3e50;
}

.center-text {
  text-align: center;
}

.right-text {
  text-align: right;
}

.left-text {
  text-align: left;
}

.input-area {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}

.input-area input,
.input-area select {
  height: 28px;
  font-size: 1em;
  padding: 4px 8px;
  border: solid 1px #ddd;
  box-shadow: 0px 0px 2px #dfdfdf;
  box-sizing: content-box;
  color: #6a6a6a;
}

.input-area input[type="file"] {
  max-width: 340px;
}

.input-area .image-input-edit {
  display: flex;
  gap: 20px;
  align-items: center;
}

.input-area select option {
  padding: 5px;
}

.input-area label {
  font-size: 1em;
  font-weight: 500;
}

.form-titulo {
  font-size: 20px;
  margin-bottom: 15px;
  display: inline-flex;
}

.content {
  padding: 25px;
  box-shadow: 1px 0px 10px #dfdfdf;
}

.content.login {
  max-width: 350px;
  width: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #f7f7f7;
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

.list-table .options a {
  display: flex;
  align-items: center;
}

.list-table .options-title {
  max-width: 140px;
}

.left {
  float: left;
}

.right {
  float: right;
}

.search {
  display: flex;
  align-items: center;
  gap: 10px;
}
</style>
