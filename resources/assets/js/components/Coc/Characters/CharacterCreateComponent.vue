<template>
  <character-form :is-create="false" />
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterForm from './CharacterFormComponent.vue';

export default Vue.extend({
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
