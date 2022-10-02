<template>
  <li v-on:click="toggleDropdown" class="menu-dropdown">
    <div class="title">
      {{ title }}
      <Icon icon="bx:chevron-down" width="22"  :rotate="open ? 2 : 0" />
    </div>
    <div v-on:click="this.$parent.toggleMenu" class="items" v-show="open">
      <router-link
        v-for="item in items"
        :key="item.to"
        :to="item.to"
        class="item"
        >{{ item.title }}</router-link
      >
    </div>
  </li>
</template>

<script>
import { Icon } from "@iconify/vue";

export default {
  name: "MenuDropdown",
  components: {
    Icon,
  },
  props: {
    title: String,
    items: [],
  },
  data() {
    return { open: false };
  },
  methods: {
    toggleDropdown() {
      this.open = !this.open;
    },
  },
};
</script>

<style scoped>
.menu-dropdown .title {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.menu-dropdown .items {
  padding: 5px 10px;
  flex-direction: column;
  display: flex;
}

.menu-dropdown .item {
  color: #ffffff;
  padding: 5px 5px;
  list-style: none;
  font-size: 16px;
  font-weight: 300;
}

.menu-dropdown .item:hover {
  background: #0051a5;
}
</style>