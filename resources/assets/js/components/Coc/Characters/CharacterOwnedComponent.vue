<template>
  <character-list :value="characters" :user-id="userId" :page-limit="pageLimit" :current="0"/>
</template>

<script lang="ts">
import Vue from 'vue';
import { Location, Route } from 'vue-router';
import axios, { AxiosPromise } from 'axios';
import CharacterList from './CharacterListComponent.vue';

// beforeRouteUpdate/Enter 両対応
const validPageGuard = function(this: Vue, to: Route, from: Route, next: (to?: any | ((vm: Vue) => any)) => any) {
  const listDefault: Location = Object.assign({}, to, {
    path: '/character/user',
    replace: true,
  });

  const callback = (vm: Vue) => {
    vm.$store.dispatch('wait');
    return vm.$store.dispatch(
      'characterList/getOwned'
    ).then(() => {
      vm.$data.loaded = true;
      vm.$store.dispatch('resolveWait');
      next();
    }).catch((e) => {
      next(listDefault);
    });
  };

  if (this !== undefined) {
    callback(this);
  } else {
    next(callback);
  }
};

export default Vue.extend({
  data() {
    return {
      loaded: false,
    }
  },
  beforeRouteEnter: validPageGuard,
  beforeRouteUpdate: validPageGuard,
  computed: {
    characters(): character[] {
      if (!this.loaded) {
        return [];
      }
      const list = this.$store.state.characterList as page;
      return list.characters;
    },
    pageLimit(): number {
      if (!this.loaded) {
        return 0;
      }
      return 0;
    },
    userId(): number {
      return this.$store.state.user.id;
    }
  },
  components: {
    CharacterList
  }
});
</script>
