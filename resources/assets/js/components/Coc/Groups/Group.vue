<template>
  <group-list :current="0" :page-limit="0" :updator="update"></group-list>
</template>

<script lang="ts">
import Vue from 'vue';
import { RouteGuardGenerator } from '../../utils/ts/RouteGuardGenerator';
import GroupList from './List.vue';

const groupsRouteGuard = RouteGuardGenerator('groupsList/get');

export default Vue.extend({
  beforeRouteEnter: groupsRouteGuard,
  beforeRouteUpdate: groupsRouteGuard,
  beforeRouteLeave(to, from, next) {
    this.$store.dispatch('groupsList/reset');
    next();
  },
  methods: {
    update() {
      this.$store.dispatch('groupsList/get');
    }
  },
  components: {
    GroupList
  }
});
</script>

<style lang="scss">

</style>
