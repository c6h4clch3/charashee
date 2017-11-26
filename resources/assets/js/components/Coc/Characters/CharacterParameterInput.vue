<template>
  <div class="form-group">
    <label class="control-label">{{ label }}</label>
    <div class="input-group">
      <input type="text" class="form-control" v-model.number="compValue">
      <span class="input-group-addon" v-if="base !== undefined">合計値: {{ sum }}</span>
      <span class="input-group-btn" v-else>
        <button type="button" class="btn btn-primary" @click="roll()">
          <span class="glyphicon glyphicon-refresh"></span>
        </button>
      </span>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mDn } from '../../config/config';

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
    theNumberOfDice: {
      type: Number,
    },
    theNumberOfFacesOfDice: {
      type: Number,
    },
    addtional: {
      type: Number,
    }
  },
  methods: {
    roll() {
      this.compValue = mDn(this.theNumberOfDice, this.theNumberOfFacesOfDice) + this.addtional;
    }
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
    },
  },
});
</script>

<style>

</style>
