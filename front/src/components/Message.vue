<template>
  <div class="message" :class="type">{{ msg }}</div>
</template>

<script>
export default {
  name: "Message",
  data() {
    return {
      msg: "",
      type: "",
    };
  },
  methods: {
    show: function (msg, type) {
      this.msg = msg;
      this.type = type;

      if (type != "loading") {
        this.close();
      }
    },

    close: function (timer = true) {
      if (timer) {
        setTimeout(() => {
          this.msg = "";
          this.type = "";
        }, 2000);
      } else {
        this.msg = "";
        this.type = "";
      }
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.message {
  height: auto;
  top: -100%;
  padding: 15px;
  box-sizing: border-box;
  position: fixed;
  right: 50px;
  min-width: 330px;
  text-align: center;
  color: #ffffff;
  border-radius: 10px;
  transition: 0.4s;
}

.message.success {
  background: #21bd77;
  top: 50px;
}

.message.error {
  background: #d34b4b;
  top: 50px;
}

.message.loading {
  background: #e0bf04;
  top: 50px;
}
</style>
