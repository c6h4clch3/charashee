<template>
  <panel>
    <span slot="title">グループ作成/編集</span>
    <div slot="body">
      <div class="form-vertical">
        <div class="form-group">
          <label class="control-label">グループ名 :</label>
          <input class="form-control" v-model="group.name">
        </div>
        <div class="form-group">
          <label class="control-label">説明 :</label>
          <textarea class="form-control" v-model="group.description" cols="30" rows="10"></textarea>
        </div>
      </div>
    </div>
  </panel>
</template>

<script lang="ts">
import Vue from 'vue';
import Panel from '../../utils/Panel.vue';

export default Vue.extend({
  props: [
    'value'
  ],
  data() {
    return {
      group: this.value as group,
    }
  },
  components: {
    Panel
  },
  updated() {
    this.$emit('input', this.group);
  }
});
</script>

