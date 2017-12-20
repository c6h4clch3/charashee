<template>
  <accordion :key="character.id" v-model="isOpen">
    <p>
      <router-link :to="`/character/${character.id}`">
        {{ character.name }}
      </router-link>
    </p>
    <div class="form-inline" :class="$style['character-container']">
      <div class="form-group">
        <label class="control-label">性別 :</label>
        <p class="form-control-static">
          {{ character.sex }}
        </p>
      </div>
      <div class="form-group">
        <label class="control-label">年齢 :</label>
        <p class="form-control-static">
          {{ character.age }}
        </p>
      </div>
      <div class="form-group">
        <label class="control-label">職業 :</label>
        <p class="form-control-static">
          {{ character.job }}
        </p>
      </div>
    </div>
    <hr>
    <div class="parameters">

    </div>
  </accordion>
</template>

<script lang="ts">
import Vue from 'vue';
import * as _ from 'lodash';
import Accordion from '../../Molecules/Accordion.vue';
export default Vue.extend({
  props: {
    value: Object,
  },
  data() {
    return {
      character: this.value,
      isOpen: false,
    };
  },
  computed: {
    parameters(): {[key: string]: number} {
      const targets = [
        'str',
        'con',
        'dex',
        'pow',
        'app',
        'siz',
        'int',
        'edu',
      ];
      const character = this.character;

      return _.mapValues(_.keyBy(targets), function(target) {
        return _.get(character, target) as number;
      });
    }
  },
  components: {
    Accordion,
  }
});
</script>

<style lang="scss" module>
.character-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 15px;
  position: relative;
}
</style>
