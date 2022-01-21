<template>
  <button v-bind:class="type" v-bind:title="title">{{ this.title }}</button>
</template>

<script>
export default {
  name: "Button",
  props: {
    title: String,
    type: String,
  },
};
</script>

<style scoped>
button {
  height: 45px;
  width: 120px;
  color: #ffffff;
  border: none;
  font-size: 18px;
  border-radius: 5px;
}

button.save {
  background: green;
}
</style>
