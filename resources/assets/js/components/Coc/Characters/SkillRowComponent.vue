<template>
  <tr>
    <td class="form-group hidden-xs">
      <input class="form-control input-sm" v-model="skill.name" :readonly="!skill.is_custom">
    </td>
    <td class="form-group">
      <input type="number" class="form-control input-sm" v-model.number="init" min="0" :readonly="!skill.is_custom || skill.reference !== null" >
    </td>
    <td class="form-group">
      <input type="number" class="form-control input-sm" v-model.number="job" min="0">
    </td>
    <td class="form-group">
      <input type="number" class="form-control input-sm" v-model.number="interest" min="0">
    </td>
    <td class="form-group">
      <input type="number" class="form-control input-sm" v-model.number="others">
    </td>
    <td class="text-center hidden-xs">
      <p>{{ sum }}</p>
    </td>
    <td class="text-center hidden-xs" @click="unset(index)">
      <span class="glyphicon glyphicon-remove"></span>
    </td>
  </tr>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions } from 'vuex';
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
  methods: {
    ...mapActions('character/skills', [
      'unset'
    ]),
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
    job: {
      get(): number {
        return this.skill.job_point;
      },
      set(value: number|string) {
        if (value === '' || value < 0) {
          value = 0;
        }
        if (typeof value === 'string') {
          value = parseInt(value);
        }
        this.skill.job_point = value;
      }
    },
    interest: {
      get(): number {
        return this.skill.interest_point;
      },
      set(value: number|string) {
        if (value === '' || value < 0) {
          value = 0;
        }
        if (typeof value === 'string') {
          value = parseInt(value);
        }
        this.skill.interest_point = value;
      }
    },
    others: {
      get(): number {
        return this.skill.others_point;
      },
      set(value: number|string) {
        if (value === '') {
          value = 0;
        }
        if (typeof value === 'string') {
          value = parseInt(value);
        }
        this.skill.others_point = value;
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
  },
  watch: {
    'value': function(newVal) {
      console.log(newVal);
      this.skill = newVal as skill;
    }
  }
});
</script>

<style>

</style>
