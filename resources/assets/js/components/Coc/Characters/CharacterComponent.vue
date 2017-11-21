<template>
  <character-list :value="characters" />
</template>

<script lang="ts">
import Vue from 'vue';
import { Location, Route } from 'vue-router';
import axios, { AxiosPromise } from 'axios';
import CharacterList from './CharacterListComponent.vue';

const validPageGuard = function(to: Route, from: Route, next: (to?: any | ((vm: Vue) => any)) => void) {
  const listDefault: Location = {
    name: 'list',
    query: {
      page: '1',
    },
  };

  if (to.query.page === undefined) {
    next(listDefault);
  }

  next((vm: Vue) => {
      vm.$store.dispatch(
        'characterList/get',
        parseInt(to.query.page)
      ).then(() => {
        next();
      }).catch(() => {
        next(listDefault);
      });
  });
};

export default Vue.extend({
  props: {
    page: {
      type: Number,
    }
  },
  beforeRouteEnter: validPageGuard,
  beforeRouteUpdate: validPageGuard,
  computed: {
    characters(): character[] {
      const list = this.$store.state.characterList as page;
      return list.characters;
    },
    pageLimit(): number {
      return this.$store.state.characterList.info.page;
    }
  },
  components: {
    CharacterList
  }
});
</script>
