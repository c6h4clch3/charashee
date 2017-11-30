<template>
  <table class="table table-bordered form-group">
    <thead>
      <tr>
        <th class="text-center">
          名称
        </th>
        <th class="text-center">
          初期値
        </th>
      </tr>
    </thead>
    <tbody>
      <template v-if="skillsets[selected] !== undefined">
        <tr v-for="(skill,index) in skillsets[selected].skills" :key="index">
          <td>
            {{ skill.name }}
          </td>
          <td>
            {{ init(skill.init, skill.reference) }}
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>

<script lang="ts">
import Vue from 'vue';
import * as _ from 'lodash';

export default Vue.extend({
  props: [
    'selected',
  ],
  computed: {
    skillsets(): skillset[] {
      return this.$store.state.skillsets;
    },
    character(): character {
      return this.$store.state.character;
    },
  },
  methods: {
    init(base: number, reference: string|null): number {
      return reference === null ? base : base * (_.get(this.character, reference as string) as number);
    },
  }
});
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0
}
</style>
