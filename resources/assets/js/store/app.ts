import Vuex from 'vuex';
import Vue from 'vue';
import character from './characters/characters';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
  },
  actions: {
  },
  mutations: {
  },
  modules: {
    character: character,
  },
});
