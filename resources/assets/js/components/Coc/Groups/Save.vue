<template>
  <fixed-column>
    <div class="col-md-2">
      <save-panel :send="send" :is-valid="isValid"></save-panel>
    </div>
  </fixed-column>
</template>

<script lang="ts">
import Vue from 'vue';
import FixedColumn from '../../utils/FixedColumn.vue';
import SavePanel from '../../utils/Save.vue';

export default Vue.extend({
  computed: {
    group(): group {
      return this.$store.state.group;
    },
    isValid(): boolean {
      return this.group.name !== '' && this.group.description !== '';
    }
  },
  methods: {
    send() {
      this.$store.dispatch('wait');
      this.$store.dispatch('group/post', this.group).then((res: group) => {
        this.$store.dispatch('resolveWait');
        this.$router.push({
          path: `/group/${res.id}/edit`
        });
      }).catch((e) => {
        this.$store.dispatch('resolveWait');
        console.error(e);
      });
    }
  },
  components: {
    SavePanel,
    FixedColumn,
  }
});
</script>

<style lang="scss">

</style>
