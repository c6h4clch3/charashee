<template>
<div>
  <section class="parameters row">
    <div class="col-md-4" v-for="param in params" :key="param.name">
      <character-parameter-input :value="param.value"
                                 :label="param.name"
                                 @input="update(param.key, $event)"
                                 :the-number-of-dice="param.dice"
                                 :the-number-of-faces-of-dice="param.faces"
                                 :addtional="param.additional" />
    </div>
  </section>
  <div class="btn-group">
    <button class="btn btn-primary" @click="roll">
      <span class="glyphicon glyphicon-refresh"></span>リロール
    </button>
  </div>
  <hr />
  <section class="row">
  </section>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import { params, mDn } from '../../config/config';
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
    params(): Parameter[] {
      return _.map(params, (val: Parameter, key: string): Parameter => {
        return {
          name: val.name,
          value: _.get(this.character, key) as number,
          key: key,
          dice: val.dice,
          faces: val.faces,
          additional: val.additional,
        };
      }) as Parameter[];
    },
    paramNames(): { [key: string]: Parameter } {
      return params;
    },
    hp(): number {
      return (this.character.con + this.character.siz) / 2;
    },
    mp(): number {
      return (this.character.pow);
    },
    san(): number {
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
    update(key: number, value: number) {
      this.$emit('input', _.set(this.character, key, value));
    },
    roll() {
      this.params.forEach((val: Parameter) => {
        _.set(this.character, val.key as _.Many<_.PropertyName>, mDn(val.dice, val.faces) + val.additional)
      });
      this.character.hp = this.hp;
      this.character.mp = this.mp;
      this.character.san = this.san;
      this.$emit('input', this.character);
    }
  },
  components: {
    CharacterParameterInput
  }
});
</script>

<style>

</style>
