<template>
  <div class="form-group">
    <label class="control-label">{{ label }}</label>
    <input type="text" class="form-control" v-model.number="compValue" v-if="base === undefined">
    <div class="input-group" v-else>
      <input type="text" class="form-control" v-model.number="compValue">
      <span class="input-group-addon">合計値: {{ sum }}</span>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  data() {
    return {
      updater: 0
    }
  },
  props: {
    base: Number,
    value: {
      type: Number,
      required: true,
      default: 0,
    },
    label: {
      type: String,
      required: true,
      default: '',
    },
  },
  updated() {
    this.$emit('input', (this.compValue + this.compBase))
  },
  computed: {
    sum(): number {
      return this.compBase + this.value;
    },
    compBase(): number {
      return this.base === undefined ? 0 : this.base;
    },
    compValue: {
      get: function(): number {
        return this.value;
      },
      set: function(value: number) {
        this.$emit('input', (this.compBase) + value);
      }
    }
  },
});
</script>

<style>

</style>
