<template>
  <character-form v-model="character" />
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterForm from './CharacterFormComponent.vue';

export default Vue.extend({
  computed: {
    character: {
      get(): character {
        return this.$store.state.character as character;
      },
      set(character: character): void {
        this.$store.dispatch('character/input', character);
      }
    },
  },
  mounted() {
    this.$store.dispatch('character/init');
  },
  components: {
    CharacterForm,
  }
});
</script>

<style>

</style>
