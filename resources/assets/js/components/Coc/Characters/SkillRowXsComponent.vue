<template>
  <tr class="visible-xs">
    <td class="text-centercol-xs-1" rowspan="2">
      {{ index }}
    </td>
    <td class="form-group" colspan="2">
      <input class="form-control input-sm" v-model="skill.name" :readonly="!skill.is_custom">
    </td>
    <td class="text-center">
      <p>{{ sum }}</p>
    </td>
    <td class="text-center">
      <span class="glyphicon glyphicon-remove"></span>
    </td>
  </tr>
</template>

<script lang="ts">
import Vue from 'vue';
import * as _ from 'lodash';

export default Vue.extend({
  props: [
    'value',
    'index'
  ],
  data() {
    return {
      skill: this.value as skill,
    }
  },
  computed: {
    init: {
      get(): number {
        if (this.skill.reference === null) {
          return this.skill.init;
        }
        return this.skill.init * _.get(this.$store.getters['character/parameters'], this.skill.reference) as number;
      },
      set(value: number|string) {
        if (value === null || value === '') {
          value = 0;
        }
        if (typeof value === 'string') {
          value = parseInt(value);
        }
        this.skill.init = value;
      }
    },
    sum(): number {
      return (this.init as number) + this.skill.job_point + this.skill.interest_point + this.skill.others_point;
    },
  },
  updated() {
    if (!_.isEqual(this.skill, this.value)) {
      this.$emit('input', this.skill);
    }
  }
});
</script>

<style>

</style>
