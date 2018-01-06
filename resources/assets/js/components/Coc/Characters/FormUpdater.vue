<template>
  <fixed-column>
    <save-panel :send="send" :is-valid="validate"></save-panel>
  </fixed-column>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions } from 'vuex';
import FixedColumn from '../../utils/FixedColumn.vue';
import SavePanel from '../../Molecules/Save.vue';

export default Vue.extend({
  computed: {
    character(): character {
      return this.$store.state.character;
    },
    skills(): skill[] {
      return this.$store.state.character.skills;
    },
    sumOfJob(): number {
      return this.$store.getters['character/skills/sumOfJob'];
    },
    validateJobPoint(): boolean {
      return this.sumOfJob <= this.character.edu * 20;
    },
    sumOfInterest(): number {
      return this.$store.getters['character/skills/sumOfInterest'];
    },
    validateInterestPoint(): boolean {
      return this.sumOfInterest <= this.character.int * 10;
    },
    validateSKillsUnique(): boolean {
      return this.$store.getters['character/skills/isUnique'];
    },
    validateNames():boolean {
      return this.character.name !== '' && this.character.age !== null && this.character.job !== '' && this.character.sex !== '';
    },
    validate(): boolean {
      return this.validateJobPoint && this.validateInterestPoint && this.validateNames && this.validateSKillsUnique;
    },
    param(): {
      id: number|undefined,
      character: character,
    } {
      return {
        id: this.id,
        character: this.character,
      }
    }
  },
  methods: {
    send() {
      this.$store.dispatch('wait');
      this.$store.dispatch('character/post', this.param).then((res: character) => {
        this.$store.dispatch('resolveWait');
        this.$router.push({
          path: `/character/${res.id}/edit`
        });
      });
    },
  },
  props: {
    id: Number,
  },
  components: {
    SavePanel,
    FixedColumn,
  }
});
</script>

<style>
.float-button-round {
  position: fixed;
  bottom: 15px;
  right: 15px;
  width: 80px;
  height: 80px;
  border-radius: 40px;
  font-size: 32px;
  pointer-events: all;
}

</style>
