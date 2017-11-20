<template>
<div class="row">
  <div class="col-md-8 col-md-push-2">
    <div class="panel panel-default">
      <router-view :id="id"></router-view>
    </div>
  </div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import 'vue-router';
import axios from 'axios';

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
  props: [
    'id'
  ],
});
</script>

<style>

</style>
