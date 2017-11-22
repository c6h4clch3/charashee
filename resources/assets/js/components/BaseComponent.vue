<template>
  
</template>

<script lang="ts">
import Vue from 'vue';

/**
 * user情報を取るためのBaseComponent.
 * ページ全体のレイアウトコンポーネントで、
 * 適宜これを継承(extend())して利用する。
 */
export default Vue.extend({
  mounted() {
    this.$store.dispatch('getUser');
  }
});
</script>

<style>

</style>
