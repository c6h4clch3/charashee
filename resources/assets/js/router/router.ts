import Vue from 'vue';
import VueRouter, { RouterOptions, Route } from 'vue-router';

import ExampleComponent from '../components/ExampleComponent.vue';
import CharacterComponent from '../components/Coc/Characters/CharacterComponent.vue';
import CharacterFormComponent from '../components/Coc/Characters/CharacterFormComponent.vue';
import { RouteConfig } from 'vue-router/types/router';
import { Component } from 'vue/types/options';

Vue.use(VueRouter);

const routes: RouteConfig[] = [
  {
    path: '/',
    component: ExampleComponent
  },
  {
    path: '/character',
    component: CharacterComponent,
    children: [
      {
        path: 'create',
        component: CharacterFormComponent
      },
      {
        path: '',
        component: {}
      }
    ]
  },
  {
    path: '/character/:id',
    component: CharacterComponent,
    props: true,
    children: [
      {
        path: 'edit',
        component: CharacterFormComponent,
      }
    ]
  },
];

export default new VueRouter({
  mode: 'history',
  base: '/store/',
  routes
} as RouterOptions);
