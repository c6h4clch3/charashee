<template>
<section class="panel-default">
  <div class="panel-heading">キャラクター作成/編集</div>
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

  </div>
</section>
</template>

<script lang="ts">
import Vue from 'vue';
import { Route } from 'vue-router';
import axios from 'axios';

const isOwned = function(to: Route, from: Route, next: (to?: any) => void): void {
  if (!to.path.match(/^\/character\/edit\/[0-9]+$/)) {
    return next();
  }
  axios.get(`/api/characters/${to.params.id}/owned`).then(
    (res) => {
      if (res.data.status) {
        next();
      } else {
        next(false);
      }
    }
  );
}

export default Vue.extend({
  data(): character {
    return this.$store.state.character as character;
  },
  updated() {
    this.$emit('input', this.$data);
  },
  mounted() {
    if (this.id !== undefined) {
      this.$store.dispatch('character/get', this.id);
    } else {
      this.$store.dispatch('character/init');
    }
  },
  props: [
    'id'
  ],
  beforeRouteUpdate (to, from, next) {
    isOwned(to, from, next);
  },
  beforeRouteEnter (to, from, next) {
    isOwned(to, from, next);
  },
});
</script>

<style>

</style>
