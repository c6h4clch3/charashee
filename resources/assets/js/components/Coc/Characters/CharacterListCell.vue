<template>
  <div class="row">
    <div class="col-sm-7">
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
    <div class="col-sm-5">
      <div class="input-group pull-right group-select">
        <select class="form-control" v-model="selectedGroup">
          <option value="" selected>選択してください</option>
          <option v-for="groupOption in groupOptions" :key="groupOption.id" :value="groupOption.id">
            {{ groupOption.name }}
          </option>
        </select>
        <span class="input-group-btn">
          <button class="btn btn-primary" @click="addCharacterToGroup(character.id, selectedGroup)"
                  :disabled="selectedGroup === ''" type="button">
            <glyphicon type="plus"></glyphicon> 追加
          </button>
        </span>
      </div>
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
import Glyphicon from '../../Atoms/Glyphicon.vue';

export default Vue.extend({
  props: {
    value: Object,
  },
  data() {
    return {
      selectedGroup: '',
    }
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
    },
    addCharacterToGroup(characterId: number, groupId: number) {
      this.$store.dispatch('group/addCharacterToGroup', {
        characterId,
        groupId,
      });
    }
  },
  computed: {
    character(): character {
      return this.value as character;
    },
    userId(): number {
      return this.$store.state.user.id as number;
    },
    groupOptions(): group[] {
      return this.$store.state.groups as group[];
    }
  },
  components: {
    Glyphicon
  }
});
</script>

<style lang="scss">
  .without-margin {
    margin: 0;
  }
  .group-select {
    margin-bottom: 4px;
  }
</style>
