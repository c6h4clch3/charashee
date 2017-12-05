import { Module } from 'vuex';
import axios from 'axios';

export default {
  namespaced: true,
  state: [] as group[],
  actions: {
    get({ commit }) {
      return axios.get<group>('/api/groups').then((res) => {
        commit('replace', res.data);
        return res.data;
      });
    },
  },
  mutations: {
    replace(state, data: group[]) {
      state.splice(0, state.length).push(...data);
    }
  },
  getters: {},
} as Module<group[], any>;
