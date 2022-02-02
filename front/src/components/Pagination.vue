<template>
  <div class="pagination" v-if="links">
    <div
      v-if="active > 1"
      class="item"
      @click="$emit('loadData', this.links.first.split('page=')[1])"
    >
      {{ fist }}
    </div>

    <div
      v-if="this.links.prev"
      class="item"
      @click="$emit('loadData', this.links.prev.split('page=')[1])"
    >
      {{ prev }}
    </div>

    <div v-for="index in total" :key="index">
      <div
        v-if="active - 3 <= index && active + 3 >= index"
        :class="(index == active ? 'active' : '') + ' item'"
        @click="$emit('loadData', index)"
      >
        {{ index }}
      </div>
    </div>

    <div
      v-if="this.links.next"
      class="item"
      @click="$emit('loadData', this.links.next.split('page=')[1])"
    >
      {{ next }}
    </div>

    <div
      v-if="active < total"
      class="item"
      @click="$emit('loadData', this.links.last.split('page=')[1])"
    >
      {{ last }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  emits: ["loadData"],
  data() {
    return {
      fist: "<",
      prev: "<<",
      next: ">>",
      last: ">",
    };
  },
  props: {
    links: Object,
    total: Number,
    active: Number,
  },
};
</script>
 
<style scoped>
.pagination {
  display: flex;
  margin-left: auto;
  width: fit-content;
  margin-right: auto;
  margin-top: 20px;
  margin-bottom: 10px;
}

.pagination .item {
  cursor: pointer;
  margin: 5px;
  background: #ededed;
  width: 30px;
  height: 30px;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination .item:hover,
.pagination .active {
  border: 1px solid #a3a3a3;
}

.pagination .item:active {
  background: #dddddd;
}
</style>
