<template>
  <div>
    <div :class="[$style.accordion]" :style="{ height: isOpened ? height : '0px' }">
      <div class="col-xs-12 target" :class="[$style.content]">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
export default Vue.extend({
  data() {
    return {
      accordion: null as Element|null,
    }
  },
  props: {
    isOpened: Boolean,
  },
  computed: {
    height(): string {
      if (this.accordion === null) {
        return '';
      }
      return window.getComputedStyle(this.accordion as Element).height as string;
    },
  },
  mounted() {
    this.accordion = this.$el.querySelector(`.target`) as Element;
  }
});
</script>

<style lang="scss" module>
.accordion {
  transition: height .2s linear 0s;
  background-color: #eee;
  height: auto;
  width: 100%;
  overflow: hidden;
}

.content {
  padding: 15px;
}
</style>
