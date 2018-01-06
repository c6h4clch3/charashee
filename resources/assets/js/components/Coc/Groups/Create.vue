<template>
  <group-form v-model="group"></group-form>
</template>

<script lang="ts">
import Vue from 'vue';
import GroupForm from './Form.vue';

export default Vue.extend({
  computed: {
    group: {
      get(): group {
        return this.$store.state.group as group;
      },
      set(value: group) {
        this.$store.dispatch('group/insert', value);
      }
    }
  },
  mounted() {
    this.$store.dispatch('group/init');
  },
  components: {
    GroupForm,
  }
});
</script>

<style lang="scss">
</style>
