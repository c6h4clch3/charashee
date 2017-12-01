<template>
  <character-read-only />
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterReadOnly from './CharacterReadOnlyComponent.vue';
import { Route } from 'vue-router';

const load = function(this: Vue, to: Route, from: Route, next: (to?: false | ((vm: Vue) => any)) => any) {
  const callback = (vm: Vue): void => {
    vm.$store.dispatch('wait');
    vm.$store.dispatch('character/get', to.params.id).then(() => {
      vm.$store.dispatch('resolveWait');
      next();
    }).catch(() => {
      next(false);
    })
  };

  if (to.params.id === undefined) {
    return next(false);
  }

  if (this === undefined) {
    next(callback);
  } else {
    callback(this);
  }
}

export default Vue.extend({
  components: {
    CharacterReadOnly,
  },
  beforeRouteEnter: load,
  beforeRouteUpdate: load,
});
</script>

<style>

</style>
