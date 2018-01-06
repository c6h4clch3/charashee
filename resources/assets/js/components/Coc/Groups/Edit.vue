<template>
  <group-form v-model="group"></group-form>
</template>

<script lang="ts">
import Vue from 'vue';
import { Route } from 'vue-router';
import { RouteGuardGenerator } from '../../utils/ts/RouteGuardGenerator';
import GroupForm from './Form.vue';

const guard = RouteGuardGenerator('group/getOwned');
export default Vue.extend({
  beforeRouteEnter: guard,
  beforeRouteUpdate: guard,
  computed: {
    group: {
      get(): group {
        return this.$store.state.group as group;
      },
      set(value: group) {
        this.$store.dispatch('group/insert', value);
      }
    },
  },
  components: {
    GroupForm
  }
});
</script>

<style lang="scss">

</style>
