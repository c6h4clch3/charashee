import Vuex from 'vuex';
import Vue from 'vue';
import character from './characters/characters';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    character_id: undefined as number|undefined,
  },
  actions: {
    character_id({commit}, id) {
      commit('character_id', id);
    },
  },
  mutations: {
    character_id(state, id) {
      state.character_id = id;
    },
  },
  modules: {
    character: character,
  },
});
