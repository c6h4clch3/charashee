<template>
  <character-list :value="characters" :user-id="userId" :page-limit="pageLimit" :current="page"/>
</template>

<script lang="ts">
import Vue from 'vue';
import { Location, Route } from 'vue-router';
import axios, { AxiosPromise } from 'axios';
import CharacterList from './CharacterListComponent.vue';

// beforeRouteUpdate/Enter 両対応
const validPageGuard = function(this: Vue, to: Route, from: Route, next: (to?: any | ((vm: Vue) => any)) => any) {
  const listDefault: Location = {
    path: '/character',
    query: {
      page: '1',
    },
    replace: true,
  };

  if (to.query.page === undefined) {
    next(listDefault);
  }

  const callback = (vm: Vue) => {
    return vm.$store.dispatch(
      'characterList/get',
      parseInt(to.query.page)
    ).then(() => {
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
  props: {
    page: {
      type: Number,
    }
  },
  beforeRouteEnter: validPageGuard,
  beforeRouteUpdate: validPageGuard,
  beforeRouteLeave(to, from, next) {
    this.$store.dispatch('characterList/reset');
    next();
  },
  computed: {
    characters(): character[] {
      const list = this.$store.state.characterList as page;
      return list.characters;
    },
    pageLimit(): number {
      return this.$store.state.characterList.info.page;
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
