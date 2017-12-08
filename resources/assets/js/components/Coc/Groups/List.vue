<template>
  <panel>
    <div slot="title">
      <slot name="header">グループ一覧</slot>
    </div>

    <div slot="body">
      <paging-list :current="current" :page-limit="pageLimit" key-name="id" :items="groups">
        <list-cell slot="item" slot-scope="group" :group="group.item" @deleted="update()"></list-cell>
      </paging-list>

      <router-link class="btn btn-primary" tag="button" :to="`/group/create`" slot="buttons">
        新規作成
      </router-link>
    </div>
  </panel>
</template>

<script lang="ts">
import Vue from 'vue';
import Panel from '../../Molecules/Panel.vue';
import PagingList from '../../Molecules/List.vue';
import ListCell from './ListCell.vue';
export default Vue.extend({
  props: {
    current: Number,
    pageLimit: Number,
    updator: Function,
  },
  computed: {
    groups(): group[] {
      return this.$store.state.groupsList;
    }
  },
  methods: {
    update() {
      if (this.updator === undefined) {
        return;
      }
      this.updator();
    }
  },
  components: {
    Panel,
    PagingList,
    ListCell,
  }
});
</script>

<style lang="scss">

</style>
