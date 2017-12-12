<template>
  <div>
    <div :class="[$style.accordion, 'accordion']" :style="{ height: isOpened ? height : '0px' }" :key="'accordion'">
      <div>
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
      return window.getComputedStyle(this.accordion.firstElementChild as Element).height as string;
    }
  },
  mounted() {
    this.accordion = this.$el.querySelector(`.accordion`) as Element;
  }
});
</script>

<style lang="scss" module>
.accordion {
  transition: height .2s linear 0s;
  height: auto;
  width: 100%;
  overflow: hidden;
}
</style>
