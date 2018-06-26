<template>
<div class="stretch">
  <div class="left">
    <router-view name="left"></router-view>
  </div>
  <div class="">
    <router-view></router-view>
  </div>
  <div class="right">
    <router-view name="right"></router-view>
  </div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import BaseComponent from '../BaseComponent.vue';

export default Vue.extend({
  mixins: [BaseComponent]
});
</script>

<style>
.stretch {
  display: grid;
  grid-template-columns: 2.5fr 8fr 1.5fr;
  grid-gap: 5px;
}
</style>
