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

</style>
