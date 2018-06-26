<template>
  <div>
    <hr :class="$style.hr">
    <div :class="$style.accordion" :style="{ height: height }">
      <div class="col-xs-12 target" :class="$style.content">
        <slot/>
      </div>
    </div>
    <div :class="$style.opener" @click="toggle()">
      {{ value ? 'close' : 'open' }}
      <glyphicon :type="value ? 'chevron-up' : 'chevron-down'"/>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Glyphicon from '../Atoms/Glyphicon.vue';

export default Vue.extend({
  data() {
    return {
      accordion: null as Element | null
    };
  },
  props: {
    value: Boolean
  },
  computed: {
    height(): string {
      if (this.accordion === null || !this.value) {
        return '0px';
      }

      return window.getComputedStyle(this.accordion as Element)
        .height as string;
    }
  },
  methods: {
    toggle() {
      this.$emit('input', !this.value);
    }
  },
  mounted() {
    this.accordion = this.$el.querySelector(`.target`) as Element;
  },
  components: {
    Glyphicon
  }
});
</script>

<style lang="scss" module>
.accordion {
  transition: height 0.2s linear 0s;
  background-color: #eee;
  height: auto;
  overflow: hidden;
  margin: 0 15px;
}

.content {
  padding: 15px;
}

.hr {
  margin: 0;
  border-color: #eef;
}

.opener {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 5px;
}
</style>
