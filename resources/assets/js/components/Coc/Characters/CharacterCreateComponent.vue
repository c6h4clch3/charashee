<template>
  <character-form />
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterForm from './CharacterFormComponent.vue';

export default Vue.extend({
  mounted() {
    this.$store.dispatch('character/init');
    this.$store.dispatch('updateIsCreate', true);
  },
  components: {
    CharacterForm,
  }
});
</script>

<style>

</style>
