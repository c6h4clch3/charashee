import Vuex from 'vuex';
import Vue from 'vue';
import character from './characters/characters';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    character_id: undefined as number|undefined,
  },
  modules: {
    character: character,
  },
});
