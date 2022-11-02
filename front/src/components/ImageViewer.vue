<template>
  <div>
    <Icon class="show-icon" @click="show" icon="cil:zoom" width="28" />
    <div class="modal-background" @click.self="close" v-show="open">
      <div
        class="modal"
        v-bind:style="{ width: modalWidth, height: modalHeight }"
      >
        <Icon class="btn close" @click="close" icon="ep:circle-close" />
        <img
          ref="image"
          v-bind:style="{
            width: imageWidth,
            maxWidth: imageMaxWidth,
            height: imageHeight,
          }"
          :src="apiUrl +'/'+ url"
        />

        <div class="zoom">
          <Icon class="btn" @click="zoomIn" icon="cil:zoom-in" width="28" />
          <Icon
            class="btn"
            @click="zoomOut"
            icon="cil:zoom-out"
            v-show="showZoomOut"
            width="28"
          />

          <Icon
            class="btn"
            @click="fullScreen"
            v-show="screenButton == 1"
            icon="akar-icons:full-screen"
            width="25"
          />
          <Icon
            class="btn"
            @click="normalScreen"
            v-show="screenButton == 2"
            icon="akar-icons:normal-screen"
            width="25"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Icon } from "@iconify/vue";

export default {
  name: "ImageViewer",
  data() {
    return {
      open: false,
      modalWidth: "unset",
      modalHeight: "unset",
      showZoomOut: false,
      screenButton: 1,
      imageOriginalWidth: false,
      imageWidth: "auto",
      imageMaxWidth: "1200px",
      imageHeight: "auto",
       apiUrl: process.env.VUE_APP_API_URL,
    };
  },
  props: {
    url: String,
  },
  components: {
    Icon,
  },
  methods: {
    show: function () {
      this.open = true;
    },
    close: function () {
      this.open = false;
      this.imageMaxWidth = "1200px";
      this.imageWidth = "auto";
      this.imageHeight = "auto";
      this.modalWidth = "unset";
      this.modalHeight = "auto";
    },

    zoomIn: function () {
      this.imageOriginalHeight = !this.imageOriginalHeight
        ? this.$refs.image.clientHeight
        : this.imageOriginalHeight;

      this.imageHeight = "unset";
      this.modalHeight = "unset";
      this.imageMaxWidth = "unset";
      this.imageHeight = this.$refs.image.clientHeight + 250 + "px";
    },

    zoomOut: function () {
      this.imageHeight = "unset";
      this.modalHeight = "unset";
      this.imageMaxWidth = "unset";
      if (this.imageOriginalHeight < this.$refs.image.clientHeight) {
        this.imageHeight = this.$refs.image.clientHeight - 250 + "px";
      }
    },

    fullScreen: function () {
      this.imageMaxWidth = "unset";
      this.imageWidth = "100%";
      this.imageHeight = "inherit";
      this.modalWidth = "100%";
      this.modalHeight = "inherit";
      this.screenButton = 2;
    },

    normalScreen: function () {
      this.imageMaxWidth = "1200px";
      this.imageWidth = "auto";
      this.imageHeight = "auto";
      this.modalWidth = "unset";
      this.modalHeight = "auto";
      this.screenButton = 1;
    },
  },

  updated() {
    if (this.imageOriginalHeight) {
      this.showZoomOut =
        this.imageOriginalHeight < this.$refs.image.clientHeight ? true : false;
    }
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.show-icon {
  margin-left: auto;
  margin-right: auto;
  display: block;
  color: #004791;
  cursor: pointer;
}

.modal-background {
  position: fixed;
  width: 100%;
  height: 100%;
  background: #000000c4;
  z-index: 2;
  top: 0;
  left: 0;
}

.modal {
  min-width: 300px;
  min-height: 180px;
  width: fit-content;
  max-width: calc(100% - 6px);
  max-height: calc(100% - 6px);
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 3;
  border: solid 2px #ffffff;
  border-radius: 10px;
  overflow: hidden;
  background: #000000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal img {
  width: 100%;
  display: block;
  object-fit: contain;
}

.modal .close {
  position: absolute;
  right: 5px;
  top: 5px;
  color: #ffffff;
  font-size: 50px;
  background: #0000004d;
  border-radius: 50%;
}

.modal .btn {
  cursor: pointer;
}

.modal .zoom {
  position: absolute;
  bottom: 8px;
  right: 10px;
  color: #ffffff;
  display: flex;
  gap: 10px;
}
</style>
