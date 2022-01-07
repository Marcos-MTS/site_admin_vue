<template>
  <div class="topo">
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
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.topo{
    height: 60px;
    width: 100%;
    background: #ddd;
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
