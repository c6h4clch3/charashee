<template>
  <span class="glyphicon" :class="[glyphiconType]"></span>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    type: String
  },
  computed: {
    glyphiconType(): string {
      return `glyphicon-${this.type}`;
    }
  }
});
</script>
