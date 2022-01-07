<template>
  <div class="topo">
  
  <div v-on:click="abreFechaMenu" class="menu-ativador" v-bind:class="{ 'aberto': menuAberto }">
    <span class="linha"></span>
    <span class="linha"></span>
    <span class="linha"></span>
  </div>
  
    <h1>{{ msg }}</h1>
  <div class="usuario">
     <img alt="Vue logo" src="../assets/logo.png">
    </div>
  
  </div>
</template>

<script>
export default {
  name: 'Topo',
  props: {
    msg: String
  },
data() {
    return { menuAberto: false }
  },
  methods:{
    abreFechaMenu(){
      this.menuAberto = true
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.menu-ativador{
      display: flex;
    flex-direction: column;
    gap: 10px;
}

.menu-ativador .linha{
  width: 45px;
  height: 4px;
  background: rgb(255, 255, 255);
}

.menu-ativador.aberto .linha{
    background: red;
}

.topo{
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

.topo .usuario img{
width: 40px;
    height: 40px;
    border-radius: 50%;
    -o-object-fit: cover;
    object-fit: cover;
    background: #ffffff;
}

</style>
