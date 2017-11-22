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
              <div class="tags">
                <ul class="list-inline">
                  <li>タグ:</li>
                  <li v-for="tag in character.tags" :key="tag">
                    {{ tag }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="btn-group pull-right" v-if="character.user_id === userId">
                <router-link class="btn btn-default" tag="button" :to="`/character/${character.id}/edit`">
                  編集
                </router-link>
                <button class="btn btn-danger">削除</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <div class="col-xs-12">
        <ul class="pagination pull-left without-margin" v-if="pageLimit > 0">
          <li :class="{ disabled: current === 1 }">
            <router-link aria-label="Previous" :to="{ query: { page: current - 1 } }" :disabled="current === 1">
              <span aria-hidden="true">&laquo;</span>
            </router-link>
          </li>
          <li v-for="n in pageLimit" :key="n" :class="{ active: n === current }" v-if="isPageShow(n, current, pageLimit, 2)">
            <router-link :aria-label="n" :to="{ query: { page: n } }">
              <span aria-hidden="true">{{ n }}</span>
            </router-link>
          </li>
          <li :class="{ disabled: current === pageLimit }">
            <router-link aria-label="Next" :to="{ query: { page: current + 1 } }" :disabled="current === pageLimit">
              <span aria-hidden="true">&raquo;</span>
            </router-link>
          </li>
        </ul>
        <span class="btn-group pull-right">
          <router-link class="btn btn-primary" tag="button" :to="`/character/create`">
            新規作成
          </router-link>
        </span>
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
    current: {
      type: Number,
    },
    pageLimit: {
      type: Number,
    },
    userId: {
      type: Number
    },
  },
  methods: {
    isPageShow(n: number, current: number, limit: number, range: number) {
      if (current <= 0 || range <= 0) {
        return false;
      }
      const isInStartRange = current <= range;
      const isInEndRange = limit - range <= current;

      if (isInStartRange) {
        return n <= range * 2 + 1;
      } else if (isInEndRange) {
        return limit - (range * 2) + 1 < n;
      } else {
        return current - range <= n && n <= current + range;
      }
    }
  },
  computed: {
    characters(): character[] {
      return this.value as character[];
    }
  }
});
</script>

<style lang="scss">
  .without-margin {
    margin: 0;
  }
</style>
