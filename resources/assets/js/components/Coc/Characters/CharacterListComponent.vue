<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      キャラクター一覧
    </div>

    <div class="panel-body">
      <ul class="list-group">
        <li class="list-group-item" v-for="character in characters" :key="character.id">
          <div class="row">
            <div class="col-sm-9">
              <h3 class="list-group-item-heading">
                {{ character.name }}
              </h3>
              <ul class="list-inline">
                <li>
                  年齢:&nbsp;{{ character.age }}
                </li>
                <li>
                  性別:&nbsp;{{ character.sex }}
                </li>
                <li>
                  職業:&nbsp;{{ character.job }}
                </li>
              </ul>
            </div>
            <div class="col-sm-3">
              <div class="btn-group pull-right" v-if="character.id === userId">
                <router-link class="btn btn-default" tag="button" :to="`/character/${character.id}/edit`">
                  編集
                </router-link>
                <button class="btn btn-danger">削除</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <div class="btn-group pull-right">
        <router-link class="btn btn-primary" tag="button" :to="`/character/create`">
          新規作成
        </router-link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    value: {
      type: Array,
    },
    userId: {
      type: Number
    },
  },
  computed: {
    characters(): character[] {
      return this.value as character[];
    }
  }
});
</script>
