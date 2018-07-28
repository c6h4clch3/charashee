<template>
  <read-only />
</template>

<script lang="ts">
import Vue from 'vue';
import { RouteGuardGenerator } from '../../utils/ts/RouteGuardGenerator';
import ReadOnly from './ReadOnly.vue';

const RouteGuard = RouteGuardGenerator('group/get');

export default Vue.extend({
  beforeRouteEnter: RouteGuard,
  beforeRouteUpdate: RouteGuard,
  components: {
    ReadOnly,
  }
});
</script>

<style lang="scss">

</style>
