<script lang="ts">
import Vue from 'vue';

/**
 * user情報を取るためのBaseComponent.
 * ページ全体のレイアウトコンポーネントで、
 * 適宜これをmixinして利用する。
 */
export default Vue.extend({
  mounted() {
    this.$store.dispatch('getUser');
    this.$store.dispatch('getSkillsets');
    this.$store.dispatch('getSkills');
    this.$store.dispatch('getGroups');
  },
});
</script>
