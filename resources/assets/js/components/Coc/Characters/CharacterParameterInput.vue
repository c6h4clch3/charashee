<template>
  <div class="form-group">
    <label class="control-label">
      {{ label }}<template v-if="base !== undefined">(初期値: {{ base }})</template>
    </label>
    <input type="number" class="form-control"
           v-model.number.lazy="compValue"
           :min="0" required
           v-if="!isEnableRoll && base === undefined">
    <div class="input-group" v-else>
      <span class="input-group-addon" v-if="base !== undefined">{{ base }} +</span>
      <input type="number" class="form-control"
             v-model.number.lazy="compValue"
             :min="base !== undefined ? undefined : 0" required>
      <span class="input-group-addon" v-if="base !== undefined">= {{ sum }}</span>
      <span class="input-group-btn" v-else>
        <button type="button" class="btn btn-primary" @click="roll()">
          <glyphicon type="refresh"></glyphicon>
        </button>
      </span>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Glyphicon from '../../Atoms/Glyphicon.vue';

export default Vue.extend({
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
    isEnableRoll: Boolean
  },
  methods: {
    roll() {
      this.$emit('roll');
    }
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
      set: function(value: number|string) {
        if (value === undefined || value === null || value === '') {
          value = 0;
        }
        if (typeof value === 'string') {
          value = parseInt(value);
        }
        if (value < 0 && this.base === undefined) {
          value = 0;
        }
        this.$emit('input', value);
      }
    },
  },
  components: {
    Glyphicon
  }
});
</script>

<style lang="scss">
.input-group {
  >*:only-child {
    border-radius: 4px !important;
  }
}
</style>
