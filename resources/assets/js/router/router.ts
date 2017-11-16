import Vue from 'vue';
import VueRouter, { RouterOptions } from 'vue-router';

import ExampleComponent from '../components/ExampleComponent.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: ExampleComponent
  }
];

export default new VueRouter({
  mode: 'history',
  base: '/store/',
  routes
} as RouterOptions);
