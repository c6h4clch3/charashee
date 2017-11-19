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
      </div>
    </section>

  </div>
</section>
</template>

<script lang="ts">
import { Component } from 'vue';
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

export default {
  data() {
    return this.$props.value as character;
  },
  props: [
    'value',
  ],
  updated() {
    this.$emit('input', this.$data);
  },
  beforeRouteUpdate (to, from, next) {
    isOwned(to, from, next);
  },
  beforeRouteEnter (to, from, next) {
    isOwned(to, from, next);
  }
} as Component;
</script>

<style>

</style>
