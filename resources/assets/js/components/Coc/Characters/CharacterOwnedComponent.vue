<template>
  <character-list :page-limit="pageLimit" :current="0" :updator="update"><span slot="header">所持キャラクター一覧</span></character-list>
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
      console.error(e);
      vm.$store.dispatch('resolveWait');
      next();
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
  beforeRouteLeave(to, from, next) {
    this.$store.dispatch('characterList/reset');
    next();
  },
  computed: {
    pageLimit(): number {
      return 0;
    },
    userId(): number {
      return this.$store.state.user.id;
    },
  },
  methods: {
    update() {
      this.$store.dispatch('wait');
      this.$store.dispatch('characterList/getOwned').then(() => {
        this.$store.dispatch('resolveWait');
      }).catch(() => {
        this.$store.dispatch('resolveWait');
      });
    }
  },
  components: {
    CharacterList
  }
});
</script>
