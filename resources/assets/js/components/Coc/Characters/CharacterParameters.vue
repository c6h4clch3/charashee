<template>
<div>
  <section class="parameters row">
    <div class="col-md-4" v-for="(param, key) in parameters" :key="key">
      <character-parameter-input :value="param"
                                 :label="key.toUpperCase()"
                                 @roll="roll(key)"
                                 @input="setValue(key, $event)"></character-parameter-input>
    </div>
  </section>
  <div class="btn-group">
    <button class="btn btn-primary" @click="rollAll">
      <span class="glyphicon glyphicon-refresh"></span>リロール
    </button>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-4">
      <character-parameter-input :value="character.hp_additional"
                                 :label="`HP補正値`"
                                 :base="character.hp"
                                 @input="setValue('hp_additional', $event)" ></character-parameter-input>
    </div>
    <div class="col-md-4">
      <character-parameter-input :value="character.mp_additional"
                                 :label="`MP補正値`"
                                 :base="character.mp"
                                 @input="setValue('mp_additional', $event)"></character-parameter-input>
    </div>
    <div class="col-md-4">
      <character-parameter-input :value="character.san"
                                 :label="`SAN値(初期値: ${character.pow * 5}, 最大値: ${99 - character.mythos_skill})`"
                                 ></character-parameter-input>
    </div>
  </div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterParameterInput from './CharacterParameterInput.vue';

export default Vue.extend({
  props: {
    isCreate: Boolean,
  },
  computed: {
    character(): character {
      return this.$store.state.character;
    },
    parameters(): any {
      return this.$store.getters['character/parameters'];
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
