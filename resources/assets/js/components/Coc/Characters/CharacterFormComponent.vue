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
          <label class="col-xs-2 control-label" for="name">名前:</label>
          <div class="col-xs-5">
            <input class="form-control" v-model="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-2 control-label" for="age">年齢:</label>
          <div class="col-xs-5">
            <input class="form-control" v-model="age" name="age">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-2 control-label" for="sex">性別:</label>
          <div class="col-xs-5">
            <input class="form-control" v-model="sex" name="sex">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-2 control-label" for="job">職業:</label>
          <div class="col-xs-5">
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
        <div class="btn-group">
          <button class="btn btn-primary">リロール</button>
        </div>
        <character-parameters v-model="character"/>
      </div>
    </section>
  </div>
</section>
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterParameters from './CharacterParameters.vue';

export default Vue.extend({
  data(): character {
    return this.value as character;
  },
  computed: {
    character:{
      get(): character {
        return this.value as character;
      },
      set(value: character) {
        this.$emit('input', value);
      }
    }
  },
  updated() {
    this.$emit('input', this.$data);
  },
  props: [
    'value'
  ],
  components: {
    CharacterParameters
  }
});
</script>

<style>

</style>
