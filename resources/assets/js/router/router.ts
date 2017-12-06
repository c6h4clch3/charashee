import Vue from 'vue';
import VueRouter, { RouterOptions, Route } from 'vue-router';

import HomeComponent from '../components/HomeComponent.vue';
import HGLayoutComponent from '../components/HGLayoutComponent.vue';
import CharacterCreateComponent from '../components/Coc/Characters/CharacterCreateComponent.vue';
import CharacterEditComponent from '../components/Coc/Characters/CharacterEditComponent.vue';
import CharacterComponent from '../components/Coc/Characters/CharacterComponent.vue';
import CharacterShowComponent from '../components/Coc/Characters/CharacterShowComponent.vue';
import CharacterOwnedComponent from '../components/Coc/Characters/CharacterOwnedComponent.vue';
import FormUpdater from '../components/Coc/Characters/FormUpdater.vue';
import GroupCreate from '../components/Coc/Groups/Create.vue';
import GroupEdit from '../components/Coc/Groups/Edit.vue';
import GroupSavePanel from '../components/Coc/Groups/Save.vue';
import { RouteConfig } from 'vue-router/types/router';
import { Component } from 'vue/types/options';

Vue.use(VueRouter);

const routes: RouteConfig[] = [
  {
    path: '/',
    component: HomeComponent
  },
  {
    path: '/character',
    component: HGLayoutComponent,
    children: [
      {
        path: '',
        name: 'list',
        components: {
          default: CharacterComponent,
        },
        props: {
          default: (route: Route) => ({
            page: parseInt(route.query.page),
          }),
        }
      },
      {
        path: 'user',
        component: CharacterOwnedComponent,
      },
      {
        path: 'create',
        components: {
          default: CharacterCreateComponent,
          left: FormUpdater
        }
      },
      {
        path: ':id',
        component: CharacterShowComponent,
        props: (route: Route) => ({
          id: parseInt(route.params.id),
        }),
      },
      {
        path: ':id/edit',
        components: {
          default: CharacterEditComponent,
          left: FormUpdater
        },
        props: {
          default: (route: Route) => ({
            id: parseInt(route.params.id)
          }),
          left: (route: Route) => ({
            id: parseInt(route.params.id),
          }),
        }
      },
    ]
  },
  {
    path: '/group',
    component: HGLayoutComponent,
    children: [
      {
        path: 'create',
        components: {
          default: GroupCreate,
          left: GroupSavePanel,
        },
      },
      {
        path: ':id/edit',
        components: {
          default: GroupEdit,
          left: GroupSavePanel,
        },
        props:{
          default: (route: Route) => ({
            id: parseInt(route.params.id),
          }),
          left: (route: Route) => ({
            id: parseInt(route.params.id),
          }),
        },
      },
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
