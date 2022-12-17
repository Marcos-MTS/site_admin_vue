<template>
  <div class="message" :class="type">
    <div v-if="this.type == 'loading'" class="loader-area">
      <div class="loader"></div>
    </div>
    <div v-if="this.type == 'success'" class="icone-area">
      <Icon icon="clarity:success-standard-solid" width="28" />
    </div>
    <div v-if="this.type == 'error'" class="icone-area">
      <Icon icon="bx:bx-error" />
    </div>
    <div v-if="this.type == 'dialog'" class="icone-area">
      <Icon icon="mdi:question-mark-circle-outline" width="40" />
    </div>
    <div class="message-area">
      {{ msg }}
    </div>
    <div class="btns-area" v-if="this.type == 'dialog'">
      <Button @click="confirm" :title="confirmButtonText" type="delete" class="right" />
      <Button @click="cancel" :title="cancelButtonText" type="cancel" class="right" />
    </div>
  </div>
</template>

<script>
import { Icon } from "@iconify/vue";
import Button from "./Button.vue";

export default {
  name: "Message",
  data() {
    return {
      msg: "",
      confirmButtonText: "",
      cancelButtonText: "",
      type: "",
      errors: null,
      resolvePromise: undefined,
      rejectPromise: undefined,
    };
  },
  components: {
    Icon,
    Button,
  },
  methods: {
    show: function (msg, type, confirmButtonText = "Excluir", cancelButtonText = "Cancelar") {
      this.msg = msg;
      this.type = type;
      this.confirmButtonText = confirmButtonText;
      this.cancelButtonText = cancelButtonText;

      if (type != "loading" && type != "dialog") {
        this.close();
      }

      if (type == "dialog") {
        return new Promise((resolve, reject) => {
          this.resolvePromise = resolve;
          this.rejectPromise = reject;
        });
      }
    },

    close: function (timer = true, time = 2000) {
      if (timer) {
        setTimeout(() => {
          this.msg = "";
          this.type = "";
        }, time);
      } else {
        this.msg = "";
        this.type = "";
      }
    },

    handleErrors: function (errors) {
      let errorFinalMessage = "";

      Object.keys(errors).forEach(function (key) {
        errors[key].forEach(function (message) {
          errorFinalMessage += message + " ";
        });
      });

      this.msg = errorFinalMessage;
      this.type = "error";
      this.close(true, 5000);
    },

    confirm() {
      this.close(false);
      this.resolvePromise();
    },

    cancel() {
      this.close(false);
      this.rejectPromise("Evento cancelado!");
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
  display: flex;
  align-items: center;
}

.btns-area {
  display: flex;
  gap: 20px;
}

.message-area {
  width: 100%;
  text-align: center;
  padding: 0 15px;
}

.loader-area {
  display: contents;
}

.icone-area {
  display: flex;
  align-items: center;
  margin-left: 5px;
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

.message.dialog {
  background: #004791;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  flex-direction: column;
  gap: 25px;
  width: fit-content;
  padding: 30px 50px;
  transition: none;
}

.loader {
  display: inline-block;
  width: 27px;
  height: 27px;
}
.loader:after {
  content: " ";
  display: block;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 4px solid #fff;
  border-color: #fff transparent #fff transparent;
  -webkit-animation: loader-61d2d687 1.2s linear infinite;
  animation: loader-61d2d687 1.2s linear infinite;
}
@keyframes loader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
