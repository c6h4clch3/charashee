<template>
  
</template>

<script lang="ts">
import Vue from 'vue';
export default Vue.extend({
  computed: {
    character(): character {
      return this.$store.state.character;
    }
  }
});
</script>

<style>

</style>
