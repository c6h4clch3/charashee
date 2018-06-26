<template>
  <ul class="pagination pull-left without-margin" v-if="pageLimit > 0">
    <li :class="{ disabled: current === 1 }">
      <router-link aria-label="Previous" :to="{ query: { page: Math.max(current - 1, 1) } }" :disabled="current === 1">
        <span aria-hidden="true">&laquo;</span>
      </router-link>
    </li>
    <li v-for="n in pageLimit" :key="n" :class="{ active: n === current }" v-if="isPageShow(n, current, pageLimit, 2)">
      <router-link :aria-label="n" :to="{ query: { page: n } }">
        <span aria-hidden="true">{{ n }}</span>
      </router-link>
    </li>
    <li :class="{ disabled: current === pageLimit }">
      <router-link aria-label="Next" :to="{ query: { page: Math.min(current + 1, pageLimit) } }" :disabled="current === pageLimit">
        <span aria-hidden="true">&raquo;</span>
      </router-link>
    </li>
  </ul>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    current: {
      type: Number
    },
    pageLimit: {
      type: Number
    }
  },
  methods: {
    isPageShow(n: number, current: number, limit: number, range: number) {
      if (current <= 0 || range <= 0) {
        return false;
      }
      const isInStartRange = current <= range;
      const isInEndRange = limit - range <= current;

      if (isInStartRange) {
        return n <= range * 2 + 1;
      } else if (isInEndRange) {
        return limit - range * 2 + 1 < n;
      } else {
        return current - range <= n && n <= current + range;
      }
    }
  }
});
</script>

<style lang="scss">
.without-margin {
  margin: 0;
}
</style>
