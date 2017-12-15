<template>
  <div :key="character.id">
    <p>
      {{ character.name }}
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
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
export default Vue.extend({
  props: {
    value: Object,
  },
  data() {
    return {
      character: this.value,
    };
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
