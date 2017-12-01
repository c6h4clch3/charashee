<template>
  <div class="fixed-panel container">
    <div class="row">
      <div class="col-md-2">
        <div class="panel panel-default hidden-xs hidden-sm">
          <div class="panel-heading">操作</div>
          <div class="panel-body">
            <button class="btn btn-primary pull-right" @click="send()" :disabled="!validate">
              <span class="glyphicon glyphicon-floppy-disk"></span> 保存
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="visible-xs visible-sm">
      <div class="bottom-bar">

      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions } from 'vuex';

export default Vue.extend({
  data(){
    return {
      wait: false
    };
  },
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
});
</script>

<style>
.fixed-panel {
  position: fixed;
  top: 73px;
  pointer-events: none;
}

.panel {
  pointer-events: all;
}

</style>
