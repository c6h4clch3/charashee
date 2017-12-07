<template>
  <panel>
    <div slot="title">
      <slot name="header">キャラクター一覧</slot>
    </div>

    <paging-list slot="body" :current="current" key-name="id" :page-limit="pageLimit" :items="characters">
      <character-list-cell slot="item" slot-scope="character" v-model="character.item" @deleted="update()"></character-list-cell>

      <router-link class="btn btn-primary" tag="button" :to="`/character/create`" slot="buttons">
        新規作成
      </router-link>
    </paging-list>
  </panel>
</template>

<script lang="ts">
import Vue from 'vue';
import Panel from '../../Molecules/Panel.vue';
import PagingList from '../../Molecules/List.vue';
import CharacterListCell from './CharacterListCell.vue';

export default Vue.extend({
  props: {
    current: {
      type: Number,
    },
    pageLimit: {
      type: Number,
    },
    updator: Function,
  },
  methods: {
    update() {
      if (this.updator === undefined) {
        return;
      }
      this.updator();
    }
  },
  computed: {
    characters(): character[] {
      return this.$store.state.characterList.characters;
    }
  },
  components: {
    Panel,
    PagingList,
    CharacterListCell,
  }
});
</script>

<style lang="scss">
  .without-margin {
    margin: 0;
  }
</style>
