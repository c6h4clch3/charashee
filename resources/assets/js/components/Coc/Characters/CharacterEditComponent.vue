<template>
  <character-form :is-create="true" />
</template>

<script lang="ts">
import Vue from 'vue';
import { Route } from 'vue-router';
import axios from 'axios';
import CharacterForm from './CharacterFormComponent.vue';

const isOwned = function(to: Route, from: Route, next: (to?: any) => void): void {
  axios.get(`/api/characters/${to.params.id}/owned`).then(
    (res) => {
      if (res.data.status) {
        next();
      } else {
        next(false);
      }
    }
  );
}

export default Vue.extend({
  mounted() {
    this.$store.dispatch('character/get', this.id);
  },
  props: [
    'id'
  ],
  beforeRouteUpdate: isOwned,
  beforeRouteEnter: isOwned,
  components: {
    CharacterForm,
  }
});
</script>

<style>

</style>
