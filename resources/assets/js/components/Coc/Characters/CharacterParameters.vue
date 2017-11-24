<template>
  <section class="parameters row">
    <div class="col-md-4" v-for="param in params" :key="param.name">
      <character-parameter-input :value="param.value" :label="param.name" @input="update(param.key, $event)" />
    </div>
  </section>
</template>

<script lang="ts">
import Vue from 'vue';
import { params } from '../../config/config';
import * as _ from 'lodash';
import CharacterParameterInput from './CharacterParameterInput.vue';

export default Vue.extend({
  props: {
    value: {
      type: Object,
    },
  },
  computed: {
    character(): character {
      return this.value;
    },
    params(): { name: string, value: number }[] {
      return _.map(params, (val: string, key: string): { name: string, value: number, key: string } => {
        return {
          name: val,
          value: _.get(this.character, key) as number,
          key: key
        }
      });
    },
    paramNames(): { [key: string]: string } {
      return params;
    }
  },
  methods: {
    update(key: number, value: number) {
      this.$emit('input', _.set(this.character, key, value));
    }
  },
  components: {
    CharacterParameterInput
  }
});
</script>

<style>

</style>
