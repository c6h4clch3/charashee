<template>
<div>
  <section class="parameters row">
    <div class="col-md-4" v-for="(param, key) in parameters" :key="key">
      <character-parameter-input :value="param"
                                 :label="key.toUpperCase()"
                                 :is-enable-roll="isCreate"
                                 @roll="roll(key)"
                                 @input="setValue(key, $event)"></character-parameter-input>
    </div>
  </section>
  <template v-if="isCreate">
    <div class="btn-group">
      <button class="btn btn-primary" @click="rollAll">
        <span class="glyphicon glyphicon-refresh"></span>リロール
      </button>
    </div>
    <p>※ 全ての入力内容がリセットされます</p>
  </template>
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
                                 :label="`SAN値(初期値: ${initSan}, 最大値: ${99 - character.mythos_skill})`"
                                 @input="setSan"></character-parameter-input>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-2 col-xs-4">
      <div class="form-group">
        <label class="control-label">幸運</label>
        <input readonly class="form-control" :value="luck" >
      </div>
    </div>
    <div class="col-md-2 col-xs-4">
      <div class="form-group">
        <label class="control-label">アイデア</label>
        <input readonly class="form-control" :value="idea" >
      </div>
    </div>
    <div class="col-md-2 col-xs-4">
      <div class="form-group">
        <label class="control-label">知識</label>
        <input readonly class="form-control" :value="knowledge" >
      </div>
    </div>
    <div class="col-md-4 col-xs-12">
      <div class="form-group">
        <label class="control-label">クトゥルフ神話技能</label>
        <input class="form-control" :value="character.mythos_skill"
               @input="setValue('mythos_skill', $event.target.value)">
      </div>
    </div>
  </div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterParameterInput from './CharacterParameterInput.vue';

export default Vue.extend({
  computed: {
    isCreate(): boolean {
      return this.$store.state.isCreate;
    },
    character(): character {
      return this.$store.state.character;
    },
    parameters(): any {
      return this.$store.getters['character/parameters'];
    },
    initSan(): number {
      return Math.min(this.character.pow * 5, 99);
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
        isCreate: this.isCreate,
      });
    },
    setSan(value: number) {
      this.$store.dispatch('character/updateParam', {
        key: 'san',
        value: Math.min(value, 99 - this.character.mythos_skill),
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
