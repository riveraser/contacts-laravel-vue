<template>
  <div>
    <transition name="fade">
      <div v-if="showDialog" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-container md:max-w-md">
          <div @click="showDialog = false" class="modal-close">
            <svg
              class="fill-current text-white"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 18 18"
            >
              <path
                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
              />
            </svg>
          </div>
          <div class="modal-content">
            <!--Title-->
            <div class="modal-title">
              <p>
                <slot name="header"></slot>
              </p>
            </div>

            <!--Body-->
            <div class="modal-body">
              <slot></slot>
            </div>
            <!--Footer-->
            <div class="modal-footer">
              <slot name="actions"></slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  name: "Modal",
  props: ["show"],
  data: function() {
    return {
      bodyElement: null
    };
  },
  created() {
    this.bodyElement = document.querySelector("body");
  },
  methods: {
    hide() {
      console.log("this.show: ", this.show);
      this.show = false;
      console.log("this.show: ", this.show);
    }
  },
  watch: {
    show(val) {
      this.bodyElement.classList.toggle("modal-active");
    }
  },
  computed: {
    showDialog: {
      // getter
      get: function() {
        return this.show;
      },
      // setter
      set: function(newValue) {
        //this.$emit("change-state", newValue);
        this.$emit("update:show", newValue);
      }
    }
  }
};
</script>
<style>
.fadeOpacity-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fadeOpacity-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
