<template>
  <div class="panel panel-default">
    <div class="panel-heading">キャラクター閲覧</div>

    <div class="panel-body">
      <section class="panel panel-default">
        <div class="panel-heading">
          キャラクター基本情報
        </div>

        <div class="panel-body">
          <div class="form-inline">
            <div class="form-group col-xs-12">
              <label class="control-label">名前 :</label>
              <p class="form-control-static">{{ character.name }}</p>
            </div>
            <div class="form-group col-xs-4">
              <label class="control-label">年齢 :</label>
              <p class="form-control-static">{{ character.age }}</p>
            </div>
            <div class="form-group col-xs-4">
              <label class="control-label">性別 :</label>
              <p class="form-control-static">{{ character.sex }}</p>
            </div>
            <div class="form-group col-xs-4">
              <label class="control-label">職業 :</label>
              <p class="form-control-static">{{ character.job }}</p>
            </div>
            <div class="form-group col-xs-12">
              <label class="control-label">タグ :</label>
              <p class="form-control-static tags" v-for="(tag, index) in character.tags" :key="index">
                <span> {{ tag }}</span>
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="panel panel-default">
        <div class="panel-heading">
          能力値
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="form-inline col-xs-12">
              <div class="form-group col-md-3 col-xs-4" v-for="(value, name) in parameters" :key="name">
                <label class="control-label">{{name.toUpperCase()}} :</label>
                <p class="form-control-static">{{value}}</p>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-inline col-xs-12">
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">HP (補正値) :</label>
                <p class="form-control-static">{{ character.hp + character.hp_additional }} ({{ character.hp_additional }})</p>
              </div>
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">MP (補正値) :</label>
                <p class="form-control-static">{{ character.mp + character.mp_additional }} ({{ character.mp_additional }})</p>
              </div>
              <div class="form-group col-sm-6 col-xs-6">
                <label class="control-label">SAN (最大値) :</label>
                <p class="form-control-static">{{ character.san }} ({{ 99 - character.mythos_skill }})</p>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-inline col-xs-12">
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">幸運 :</label>
                <p class="form-control-static">{{ character.pow * 5 }}</p>
              </div>
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">アイデア :</label>
                <p class="form-control-static">{{ character.int * 5 }}</p>
              </div>
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">知識 :</label>
                <p class="form-control-static">{{ character.edu * 5 }}</p>
              </div>
              <div class="form-group col-sm-3 col-xs-4">
                <label class="control-label">クトゥルフ神話 :</label>
                <p class="form-control-static">{{ character.mythos_skill }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="panel panel-default">
        <div class="panel-heading">技能</div>
        <div class="panel-body">
          <div class="row">
            <div class="form-inline col-xs-12">
              <div class="form-group col-xs-6">
                <label class="control-label">職業ポイント</label>
                <p class="form-control-static">
                  {{ sumOfJob }} / {{ character.edu * 20 }}
                </p>
              </div>
              <div class="form-group col-xs-6">
                <label class="control-label">興味ポイント</label>
                <p class="form-control-static">
                  {{ sumOfInterest }} / {{ character.int * 10 }}
                </p>
              </div>
            </div>
          </div>
          <hr>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  名称
                </th>
                <th>
                  合計値
                </th>
                <th>
                  内訳
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(skill, index) in character.skills" :key="index">
                <td>
                  {{ skill.name }}
                </td>
                <td>
                  {{ init(skill.init, skill.reference) + skill.job_point + skill.interest_point + skill.others_point }}
                </td>
                <td>
                  ({{ init(skill.init, skill.reference) }} + {{ skill.job_point }} + {{ skill.interest_point }} + {{ skill.others_point }})
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="panel panel-default">
        <div class="panel-heading">その他/備考</div>
        <div class="panel-body">
          <p>
            <pre>{{ character.comment }}</pre>
          </p>
        </div>
      </section>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import * as _ from 'lodash';

export default Vue.extend({
  computed: {
    character(): character {
      return this.$store.state.character;
    },
    parameters(): {[key:string]: number} {
      return this.$store.getters['character/parameters'];
    },
    sumOfJob(): number {
      return this.$store.getters['character/skills/sumOfJob'];
    },
    sumOfInterest(): number {
      return this.$store.getters['character/skills/sumOfInterest'];
    },
  },
  methods: {
    init(init: number, reference: null|string): number {
      if (reference === null) {
        return init;
      }
      return init * (_.get(this.character, reference) as number);
    }
  }
});
</script>

<style>
.tags {
  margin-right: 5px;
}
</style>
