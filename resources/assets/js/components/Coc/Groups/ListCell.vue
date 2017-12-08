<template>
  <div class="row">
    <div class="col-sm-9">
      <h4>{{ group.name }}</h4>
      <hr>
      <div class="form-inline">
        <label class="control-label">説明 :</label>
        <p class="form-control-static">{{ group.description }}</p>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="btn-group pull-right" v-if="userId === group.user_id">
        <router-link :to="`/group/${group.id}/edit`"
                     tag="button" class="btn btn-default">
          編集
        </router-link>
        <button type="button" class="btn btn-danger" @click="deleteGroup(group.id)">
          削除
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
export default Vue.extend({
  props: {
    group: Object,
  },
  computed: {
    userId(): number {
      return this.$store.state.user.id;
    }
  },
  methods: {
    deleteGroup(id: number) {
      this.$store.dispatch('wait');
      this.$store.dispatch('group/delete', id).then(() => {
        this.$store.dispatch('resolveWait');
        this.$emit('deleted');
      }).catch((e) => {
        console.error(e);
        this.$store.dispatch('resolveWait');
      });
    }
  }
});
</script>

<style lang="scss">

</style>
