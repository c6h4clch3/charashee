<template>
  <div>
    <panel class="hidden-xs hidden-sm">
      <span slot="title">操作</span>
      <div slot="body">
        <button class="btn btn-primary pull-right" @click="send()" :disabled="!isValid">
          <span class="glyphicon glyphicon-floppy-disk"></span> 保存
        </button>
      </div>
    </panel>
    <div class="visible-xs visible-sm">
      <button class="btn btn-primary float-button-round" @click="send()" :disabled="!isValid">
        <span class="glyphicon glyphicon-floppy-disk"></span>
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions } from 'vuex';
import Panel from '../Molecules/Panel.vue';

export default Vue.extend({
  props: {
    isValid: Boolean,
    send: Function,
  },
  components: {
    Panel
  }
});
</script>

<style>
.float-button-round {
  position: fixed;
  bottom: 15px;
  right: 15px;
  width: 80px;
  height: 80px;
  border-radius: 40px;
  font-size: 32px;
  pointer-events: all;
  z-index: 100;
}
</style>
