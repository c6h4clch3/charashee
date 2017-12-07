<template>
<div class="row stretch">
  <div class="col-md-8 col-md-push-2">
    <router-view></router-view>
  </div>
  <div class="col-md-2 col-md-pull-8 left">
    <router-view name="left"></router-view>
  </div>
  <div class="col-md-2 right">
    <router-view name="right"></router-view>
  </div>
</div>
</template>

<script lang="ts">
import Vue from 'vue';
import BaseComponent from '../BaseComponent.vue';

export default Vue.extend({
  mixins: [
    BaseComponent
  ]
});
</script>

<style>
.stretch {
  display: inherit;
}

.center {
  z-index: 0;
}

.left {
  z-index: 100;
}

.right {
  z-index: 200;
}
</style>
