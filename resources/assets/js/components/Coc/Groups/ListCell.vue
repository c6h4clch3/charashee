<template>
  <div class="row">
    <div class="col-sm-12">
      <h3 :class="$style['flex-head']">
        <span @click.self="toggle()">
          {{ group.name }}
        </span>

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
      <accordion :is-opened="isOpened">
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
          <div :key="character.id">
            <p>
              {{ character.name }}
            </p>
            <div>
              <div class="form-group">
                <label class="control-label">性別 :</label>
                <p class="form-control-static">
                  {{ character.sex }}
                </p>
              </div>
              <div class="form-group">
                <label class="control-label">年齢 :</label>
                <p class="form-control-static">
                  {{ character.age }}
                </p>
              </div>
              <div class="form-group">
                <label class="control-label">職業 :</label>
                <p class="form-control-static">
                  {{ character.job }}
                </p>
              </div>
            </div>
          </div>
        </template>
      </accordion>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Accordion from '../../Molecules/Accordion.vue';

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
    Accordion
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
