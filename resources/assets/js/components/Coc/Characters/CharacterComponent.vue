<template>
  <character-list :page-limit="pageLimit" :current="page" :updator="update" />
</template>

<script lang="ts">
import Vue from "vue";
import { Location, Route } from "vue-router";
import axios, { AxiosPromise } from "axios";
import CharacterList from "./CharacterListComponent.vue";

// beforeRouteUpdate/Enter 両対応
const validPageGuard = function(
  this: Vue,
  to: Route,
  from: Route,
  next: (to?: any | ((vm: Vue) => any)) => any
) {
  const listDefault: Location = Object.assign({}, to, {
    path: "/character",
    query: {
      page: "1"
    },
    replace: true
  });

  if (to.query.page === undefined) {
    next(listDefault);
  }

  const callback = (vm: Vue) => {
    vm.$store.dispatch("wait");
    return vm.$store
      .dispatch("characterList/get", parseInt(to.query.page as string))
      .then(() => {
        vm.$data.loaded = true;
        vm.$store.dispatch("resolveWait");
        next();
      })
      .catch(e => {
        if (to.query.page === "1") {
          vm.$store.dispatch("resolveWait");
          next();
        }
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
      loaded: false
    };
  },
  props: {
    page: {
      type: Number
    }
  },
  beforeRouteEnter: validPageGuard,
  beforeRouteUpdate: validPageGuard,
  beforeRouteLeave(to, from, next) {
    this.$store.dispatch("characterList/reset");
    next();
  },
  computed: {
    pageLimit(): number {
      if (!this.loaded) {
        return 0;
      }
      return this.$store.state.characterList.info.page;
    }
  },
  methods: {
    update() {
      this.$store.dispatch("wait");
      this.$store
        .dispatch("characterList/get", this.page)
        .then(() => {
          this.$store.dispatch("resolveWait");
        })
        .catch(() => {
          this.$store.dispatch("resolveWait");
        });
    }
  },
  components: {
    CharacterList
  }
});
</script>
