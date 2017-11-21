import Vuex from 'vuex';
import Vue from 'vue';
import character from './character/character';
import characterList from './characterList/characterList';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
  },
  actions: {
  },
  mutations: {
  },
  modules: {
    character,
    characterList,
  },
});
