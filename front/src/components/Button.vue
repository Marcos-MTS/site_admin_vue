<template>
  <button v-bind:class="type" v-bind:title="title">
    <Icon v-if="type == 'save'" icon="bx:bxs-save" width="28" />
    <Icon
      v-if="type == 'go-back'"
      icon="bi:arrow-left-circle-fill"
      width="28"
    />
    <Icon v-if="type == 'new'" icon="carbon:add-filled" width="28" />
    {{ this.title }}
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
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}

button.save {
  background: green;
}

button.new {
  background: green;
}

button.go-back {
  background: #6075c3;
}
</style>
