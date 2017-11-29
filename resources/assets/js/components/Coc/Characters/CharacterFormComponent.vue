<template>
<section class="panel panel-default">
  <div class="panel-heading">
    キャラクター作成/編集
  </div>

  <div class="panel-body">
    <section class="panel panel-default form-horizontal">
      <div class="panel-heading">キャラクター基本情報</div>
      <div class="panel-body">
        <div class="form-group">
          <label class="col-md-2 control-label" for="name">名前:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="age">年齢:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="age" name="age">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="sex">性別:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="sex" name="sex">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="job">職業:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="job" name="job">
          </div>
        </div>
      </div>
    </section>

    <section class="panel panel-default">
      <div class="panel-heading">
        能力値
      </div>

      <div class="panel-body">
        <character-parameters />
      </div>
    </section>

    <section class="panel panel-default">
      <div class="panel-heading">
        技能値
      </div>

      <div class="panel-body">
        <character-skills />
      </div>
    </section>
  </div>
</section>
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterParameters from './CharacterParameters.vue';
import CharacterSkills from './CharacterSkillsComponent.vue';

export default Vue.extend({
  data(): character {
    return this.$store.state.character as character;
  },
  computed: {
    character(): character {
      return this.$store.state.character as character;
    }
  },
  updated() {
    this.$store.dispatch('character/input', this.$data);
  },
  props: [
    'isCreate'
  ],
  components: {
    CharacterParameters,
    CharacterSkills
  }
});
</script>

<style>

</style>
