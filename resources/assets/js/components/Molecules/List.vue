<template>
  <div>
    <ul class="list-group">
      <li class="list-group-item" v-for="item in items" :key="getKey(item)">
        <slot name="item" :item="item"></slot>
      </li>
    </ul>
    <div class="col-xs-12">
      <pagination :page-limit="pageLimit" :current="current"></pagination>
      <span class="btn-group pull-right">
        <slot name="buttons"></slot>
      </span>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Pagination from './Pagination.vue';
import * as _ from 'lodash';

export default Vue.extend({
  data() {
    return {
      keyname: ''
    };
  },
  props: {
    current: {
      type: Number
    },
    pageLimit: {
      type: Number
    },
    keyName: {
      type: String
    },
    items: {
      type: Array as () => Array<any>
    }
  },
  methods: {
    getKey(item: object): any {
      return _.get(item, this.keyName);
    }
  },
  components: {
    Pagination
  }
});
</script>
