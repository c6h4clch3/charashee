import Vue from 'vue';

// Vue.js CSS Modules 対応
declare module 'vue/types/vue' {
  interface Vue {
    $style: {[key: string]: string}
  }
}
