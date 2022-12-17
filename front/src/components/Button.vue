<template>
  <button v-bind:class="type" v-bind:title="title">
    <Icon v-if="type == 'save'" icon="bx:bxs-save" width="28" />
    <Icon
      v-if="type == 'go-back'"
      icon="bi:arrow-left-circle-fill"
      width="28"
    />
    <Icon v-if="type == 'new'" icon="carbon:add-filled" width="28" />
    <Icon v-if="type == 'search'" icon="fa-solid:search" width="28" />
    <Icon v-if="type == 'login'" icon="ant-design:login-outlined" width="28" />
    <Icon v-if="type == 'cancel'" icon="material-symbols:cancel" width="28" />
    <Icon v-if="type == 'delete'" icon="fluent:delete-dismiss-24-filled" width="28" />

    <span> {{ this.title }} </span>
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
  width: fit-content;
  color: #ffffff;
  border: none;
  font-size: 18px;
  border-radius: 5px;
  box-sizing: unset;
  padding: 0 12px 0 8px;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  cursor: pointer;
}

button:hover {
filter: brightness(0.9);
}

button span {
  margin-left: 8px;
}

button.save {
  background: green;
}

button.delete {
  background: #e50202;
}

button.cancel {
  background: gray;
}

button.search {
  background: rgb(4, 74, 114);
}

button.new {
  background: green;
}

button.login {
  background: green;
}

button.go-back {
  background: #6075c3;
}
</style>
