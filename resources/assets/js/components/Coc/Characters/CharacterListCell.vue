<template>
  <div class="row">
    <div class="col-sm-9">
      <h3 class="list-group-item-heading">
        <router-link :to="`/character/${character.id}`">{{ character.name }}</router-link>
      </h3>
      <ul class="list-inline">
        <li>
          年齢:&nbsp;{{ character.age }}
        </li>
        <li>
          性別:&nbsp;{{ character.sex }}
        </li>
        <li>
          職業:&nbsp;{{ character.job }}
        </li>
      </ul>
      <div class="tags">
        <ul class="list-inline">
          <li>タグ:</li>
          <li v-for="tag in character.tags" :key="tag">
            {{ tag }}
          </li>
        </ul>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="btn-group pull-right" v-if="character.user_id === userId">
        <router-link class="btn btn-default" tag="button" :to="`/character/${character.id}/edit`">
          編集
        </router-link>
        <button class="btn btn-danger" @click="deleteCharacter(character.id)">削除</button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    value: Object,
  },
  methods: {
    deleteCharacter(id: number) {
      this.$store.dispatch('wait');
      this.$store.dispatch('character/delete', id).then(() => {
        this.$store.dispatch('resolveWait');
        this.$emit('deleted');
      }).catch(() => {
        this.$store.dispatch('resolveWait');
      });
    }
  },
  computed: {
    character(): character {
      return this.value as character;
    },
    userId(): number {
      return this.$store.state.user.id as number;
    }
  },
});
</script>

<style lang="scss">
  .without-margin {
    margin: 0;
  }
</style>
