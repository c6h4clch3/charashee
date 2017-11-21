import Vue from 'vue';
import VueRouter, { RouterOptions, Route } from 'vue-router';

import ExampleComponent from '../components/ExampleComponent.vue';
import HGLayoutComponent from '../components/HGLayoutComponent.vue';
import CharacterCreateComponent from '../components/Coc/Characters/CharacterCreateComponent.vue';
import CharacterEditComponent from '../components/Coc/Characters/CharacterEditComponent.vue';
import CharacterComponent from '../components/Coc/Characters/CharacterComponent.vue';
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
    component: HGLayoutComponent,
    children: [
      {
        path: '',
        name: 'list',
        component: CharacterComponent,
        props: (route) => ({
          page: parseInt(route.query.page),
        }),
      },
      {
        path: 'create',
        component: CharacterCreateComponent
      },
      {
        path: ':id',
        component: {
          template: `<p>未実装</p>`,
        },
        props: true,
      },
      {
        path: ':id/edit',
        component: CharacterEditComponent,
        props: true,
      }
    ]
  },
  {
    path: '*',
    component: {
      template: `
        <div class="col-md-8 col-md-push-2 text-center">
          <h1>404 Not Found</h1>
        </div>
      `
    }
  }
];

export default new VueRouter({
  mode: 'history',
  base: '/store/',
  routes
} as RouterOptions);
