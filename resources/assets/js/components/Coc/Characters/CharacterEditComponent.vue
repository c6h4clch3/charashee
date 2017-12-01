<template>
  <character-form />
</template>

<script lang="ts">
import Vue from 'vue';
import { Route } from 'vue-router';
import axios from 'axios';
import CharacterForm from './CharacterFormComponent.vue';

const isOwned = function(to: Route, from: Route, next: (to?: any) => void): void {
  axios.get(`/api/characters/${to.params.id}/owned`).then(
    (res) => {
      if (res.status === 200 && res.data.status) {
        next();
      } else {
        next(false);
      }
    }
  );
}

export default Vue.extend({
  mounted() {
    this.$store.dispatch('wait');
    this.$store.dispatch('character/get', this.id).then(() => {
      this.$store.dispatch('character/skills/init');
      this.$store.dispatch('resolveWait');
    });
    this.$store.dispatch('updateIsCreate', false);
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
