<template>
<div>
  <section class="parameters row">
    <div class="col-md-4" v-for="(param, key) in params" :key="key">
      <character-parameter-input :value="getValue(key)"
                                 :label="param.name"
                                 @roll="roll(key)"
                                 @input="setValue(key, $event)" />
    </div>
  </section>
  <div class="btn-group">
    <button class="btn btn-primary" @click="rollAll">
      <span class="glyphicon glyphicon-refresh"></span>リロール
    </button>
  </div>
  <hr />
  <div class="row"></div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import { params } from '../../config/config';
import { mDn } from '../../utils/mdn';
import * as _ from 'lodash';
import CharacterParameterInput from './CharacterParameterInput.vue';

export default Vue.extend({
  props: {
    isCreate: Boolean,
  },
  computed: {
    character(): character {
      return this.$store.state.character;
    },
    paramNames(): string[] {
      return Object.keys(params);
    },
    params(): {[key: string]: Parameter} {
      return params;
    },
    initSan(): number {
      return this.character.pow * 5;
    },
    luck(): number {
      return this.character.pow * 5;
    },
    idea(): number {
      return this.character.int * 5;
    },
    knowledge(): number {
      return this.character.edu * 5;
    }
  },
  methods: {
    rollAll() {
      this.$store.dispatch('character/rollAll');
    },
    getValue(key: string): number {
      return _.get<character, string>(this.character, key) as number;
    },
    setValue(key: string, value: number) {
      this.$store.dispatch('character/updateParam', {
        key: key,
        value: value,
      });
    },
    roll(key: string) {
      this.$store.dispatch('character/roll', key);
    }
  },
  components: {
    CharacterParameterInput
  }
});
</script>

<style>

</style>
