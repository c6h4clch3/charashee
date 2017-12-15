<template>
  <div class="row">
    <div class="col-sm-12">
      <h3 :class="$style['flex-head']" @click.self="toggle()">
        {{ group.name }}

        <span>
          <div class="btn-group" v-if="userId === group.user_id">
            <router-link :to="`/group/${group.id}/edit`"
                         tag="button" class="btn btn-default">
              編集
            </router-link>
            <button type="button" class="btn btn-danger" @click="deleteGroup(group.id)">
              削除
            </button>
          </div>
        </span>
      </h3>
      <accordion v-model="isOpened">
        <div class="form-inline">
          <div class="form-group">
            <label class="control-label">説明 : </label>
            <p class="form-control-static">
              {{ group.description }}
            </p>
          </div>
        </div>
        <template v-for="(character, key) in group.characters">
          <hr :key="key" :class="$style.hr">
          <character-info
            :value="character"
            :key="character.id"/>
        </template>
      </accordion>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Accordion from '../../Molecules/Accordion.vue';
import CharacterInfo from './ListCellCharacterInfo.vue';

export default Vue.extend({
  data() {
    return {
      isOpened: false,
    }
  },
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
    },
    toggle() {
      this.isOpened = !this.isOpened;
    }
  },
  components: {
    Accordion,
    CharacterInfo,
  }
});
</script>

<style lang="scss" module>
.flex-head {
  align-items: center;
  display: flex;
  justify-content: space-between;
}

.hr {
  border-color: #ccc;
}
</style>
