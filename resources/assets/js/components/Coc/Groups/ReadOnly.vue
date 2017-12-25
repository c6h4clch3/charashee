<template>
  <panel>
    <div slot="title">グループ詳細</div>

    <div slot="body">
      <h2>{{ group.name }}</h2>
      <hr>
      <div class="form-group">
        <label class="control-label">詳細</label>
        <pre class="form-control-static">{{ group.description }}</pre>
      </div>
      <hr>
      <div>
        <panel v-for="character in group.characters" :key="character.id">
          <div slot="title">
            <h5>{{ character.name }}</h5>
          </div>
          <div slot="body">
            <div :class="$style.grid">
              <div class="form-group">
                <label class="control-label">性別 : </label>
                <p class="form-control-static">
                  {{ character.sex }}
                </p>
              </div>
              <div class="form-group">
                <label class="control-label">年齢 : </label>
                <p class="form-control-static">
                  {{ character.age }}
                </p>
              </div>
              <div class="form-group">
                <label class="control-label">職業 : </label>
                <p class="form-control-static">
                  {{ character.job }}
                </p>
              </div>
            </div>
            <character-info :value="character"></character-info>
          </div>
        </panel>
      </div>
    </div>
  </panel>
</template>

<script lang="ts">
import Vue from 'vue';
import Panel from '../../Molecules/Panel.vue';
import Accordion from '../../Molecules/Accordion.vue';
import CharacterInfo from './ReadOnlyCharacterInfo.vue';

export default Vue.extend({
  computed: {
    group(): group {
      return this.$store.state.group as group;
    }
  },
  components: {
    Panel,
    Accordion,
    CharacterInfo,
  }
});
</script>

<style lang="scss" module>
.grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
}

</style>
