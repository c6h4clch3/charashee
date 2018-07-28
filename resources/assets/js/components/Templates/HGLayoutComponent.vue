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
  mixins: [
    BaseComponent
  ]
});
</script>

<style>
.stretch {
  display: grid;
  grid-template-columns: 2fr 8fr 2fr;
  grid-gap: 5px;
}

@media screen and (max-width: 767px){
  .stretch {
    grid-template-columns: 1fr;
  }
}

.left {
  z-index: 1;
}

.right {
  z-index: 2;
}

</style>
