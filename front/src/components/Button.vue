<template>
  <button v-bind:class="type" v-bind:title="title">
    <Icon icon="bx:bxs-save" width="28" />{{ this.title }}
  </button>
</template>

<script>
import { Icon } from "@iconify/vue";

export default {
  name: "Button",
  components: {
    Icon,
  },
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
  padding-right: 5px;
}

button.save {
  background: green;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
</style>
