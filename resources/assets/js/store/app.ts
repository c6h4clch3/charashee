import Vuex from 'vuex';
import Vue from 'vue';
import axios from 'axios';

import character from './character/character';
import characterList from './characterList/characterList';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: {
      id: 0,
      name: '',
      email: '',
    } as user
  },
  actions: {
    getUser({commit}) {
      return axios.get<user>('/api/user').then((res) => {
        commit('user', res.data);
      });
    }
  },
  mutations: {
    user(state, user: user) {
      state.user.id = user.id;
      state.user.name = user.name;
      state.user.email = user.email;
    }
  },
  modules: {
    character,
    characterList,
  },
});
