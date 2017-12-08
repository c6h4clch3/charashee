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
        <tr class="visible-xs">
          <th class="text-center col-xs-1" rowspan="2">
            #
          </th>
          <th class="text-center" colspan="2">
            名称
          </th>
          <th class="text-center">
            合計
          </th>
          <th class="text-center">
            削除
          </th>
        </tr>
        <tr>
          <th class="text-center col-xs-4 hidden-xs">
            名称
          </th>
          <th class="text-center">
            初期値
          </th>
          <th class="text-center">
            職業
          </th>
          <th class="text-center">
            興味
          </th>
          <th class="text-center">
            その他
          </th>
          <th class="text-center col-xs-1 hidden-xs">
            合計
          </th>
          <th class="text-center col-xs-1 hidden-xs">
            削除
          </th>
        </tr>
      </thead>
      <transition-group tag="tbody" name="fade">
        <template v-for="(skill, key) in skills">
          <skill-row-xs :key="`${skill.key}-xs`" :value="skill" :index="key" @input="update({ id: key, skill: skill })" :class="{ 'danger' : !isUnique }"></skill-row-xs>
          <skill-row :key="`${skill.key}`" :value="skill" :index="key" @input="update({ id: key, skill: skill })" :class="{ 'danger' : !isUnique }"></skill-row>
        </template>
      </transition-group>
    </table>
    <hr>
    <div clsss="button-group">
      <button class="btn btn-primary" @click="create()">
        <glyphicon type="plus"></glyphicon> 空欄追加
      </button>
      <button class="btn btn-default" data-toggle="modal" data-target="#skill" @click="() => { selectedSkillset = ''; selectedSkill = ''; }">一括技能追加</button>
    </div>
    <modal id="skill">
      <span slot="title">一括技能追加</span>
      <div>
        <div class="form-inline form-group">
          <div class="form-group">
            <label class="control-label">職業技能から一括で追加</label>
            <select class="form-control" v-model="selectedSkillset">
              <option selected value="">選択してください</option>
              <option v-for="(skillset,index) in skillsets" :key="skillset.id" :value="index">{{skillset.name}}</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" :disabled="selectedSkillset === ''" data-dismiss="modal" @click="pushByArray(skillsets[selectedSkillset].skills)">
              <glyphicon type="plus"></glyphicon> 追加
            </button>
          </div>
        </div>
        <div class="col-xs-12 table-responsive hidden-xs hidden-sm">
          <skillsets-skills-table v-if="!(selectedSkillset === '')" :selected="selectedSkillset"></skillsets-skills-table>
        </div>
        <hr>
        <div class="form-inline">
          <div class="form-group">
            <label class="control-label">基本技能から1件追加</label>
            <select class="form-control" v-model="selectedSkill">
              <option selected value="">選択してください</option>
              <option v-for="(skill, index) in skillOptions" :key="index" :value="index">{{ skill.name }}</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" :disabled="selectedSkill === ''" data-dismiss="modal"
                    @click="push(Object.assign({job_point: 0, interest_point: 0, others_point: 0}, skillOptions[selectedSkill]))">
              <glyphicon type="plus"></glyphicon> 追加
            </button>
          </div>
        </div>
      </div>
    </modal>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapActions, mapGetters } from 'vuex';
import SkillRow from './SkillRowComponent.vue';
import SkillRowXs from './SkillRowXsComponent.vue';
import SkillsetsSkillsTable from './SkillsetsSkillsTable.vue';
import Modal from '../../Molecules/Modal.vue';
import Glyphicon from '../../Atoms/Glyphicon.vue';

export default Vue.extend({
  data() {
    return {
      counter: 0,
      selectedSkillset: '' as string|number,
      selectedSkill: '' as string|number,
    }
  },
  computed: {
    skills(): skill[] {
      return this.$store.state.character.skills;
    },
    skillOptions(): skill[] {
      return this.$store.state.skills;
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
      this.$store.dispatch('character/skills/push', {
        name: '',
        init: 0,
        reference: null,
        is_custom: true,
        job_point: 0,
        interest_point: 0,
        others_point: 0,
      } as skill);
    },
    count(): number {
      this.counter++;
      return this.counter;
    },
    ...mapActions('character/skills', [
      'push',
      'pushByArray',
      'update',
      'unset',
    ]),
  },
  components: {
    SkillRow,
    SkillRowXs,
    SkillsetsSkillsTable,
    Modal,
    Glyphicon,
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
