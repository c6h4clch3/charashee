
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue';

import store from './store/app';
import router from './router/router';
import DataParser from './plugins/data-parser.js';
import Loading from './components/utils/Loading.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(DataParser);
const app = new Vue({
  el: '#app',
  store,
  router,
  computed: {
    userName(): string {
      return this.$store.state.user.name;
    },
    wait(): boolean {
      return this.$store.state.wait;
    }
  },
  components: {
    Loading
  }
});
