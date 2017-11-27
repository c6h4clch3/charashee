<template>
<div>
  <section class="parameters row">
    <div class="col-md-4" v-for="(param, key) in character" :key="key">
      <character-parameter-input :value="param"
                                 :label="key.toUpperCase()"
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
import CharacterParameterInput from './CharacterParameterInput.vue';

export default Vue.extend({
  props: {
    isCreate: Boolean,
  },
  computed: {
    character(): any {
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
