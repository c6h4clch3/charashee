<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group" :class="{ 'has-error': (sumOfJob > jobLimit) }">
          <label class="control-label">職業ポイント</label>
          <div class="input-group input-group-sm">
            <input class="form-control" readonly :value="sumOfJob">
            <span class="input-group-addon">
              / {{ jobLimit }}
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group" :class="{ 'has-error': (sumOfInterest > interestLimit) }">
          <label class="control-label">興味ポイント</label>
          <div class="input-group input-group-sm">
            <input class="form-control" readonly :value="sumOfInterest">
            <span class="input-group-addon">
              / {{ interestLimit }}
            </span>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center col-xs-2">
            名称
          </th>
          <th class="text-center col-xs-2">
            初期値
          </th>
          <th class="text-center col-xs-2">
            職業
          </th>
          <th class="text-center col-xs-2">
            興味
          </th>
          <th class="text-center col-xs-2">
            その他
          </th>
          <th class="text-center col-xs-1">
            合計
          </th>
          <th class="text-center col-xs-1">
            削除
          </th>
        </tr>
      </thead>
      <tbody>
        <skill-row v-for="(skill, key) in skills" :key="key" :value="skill" @input="update({ id: key, skill: skill })" :class="{ 'danger' : !isUnique }"></skill-row>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions, mapGetters } from 'vuex';
import SkillRow from './SkillRowComponent.vue';

export default Vue.extend({
  computed: {
    skills(): skill[] {
      return this.$store.state.character.skills;
    },
    skillsets(): skillset[] {
      return this.$store.state.skillsets;
    },
    jobLimit(): number {
      return this.$store.state.character.edu * 20;
    },
    interestLimit(): number {
      return this.$store.state.character.int * 10;
    },
    ...mapGetters('character/skills', [
      'isUnique',
      'sumOfJob',
      'sumOfInterest',
      'duplicates'
    ]),
  },
  methods: {
    create() {
      this.push({
        name: '',
        init: 0,
        reference: null,
        is_custom: true,
        job_point: 0,
        interest_point: 0,
        others_point: 0,
      } as skill);
    },
    ...mapActions('character/skills', [
      'push',
      'replaceBySkillset',
      'update',
    ]),
  },
  components: {
    SkillRow
  }
});
</script>

<style lang="scss" scoped>
.form-control:read-only {
  background-color: #fff;
}

.form-group.has-error {
  .form-control:read-only {
    background-color: #faa;
  }
}
</style>
