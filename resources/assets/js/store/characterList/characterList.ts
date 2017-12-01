import { Module } from 'vuex';
import axios, { AxiosPromise } from 'axios';

export default {
  namespaced: true,
  state: {
    characters: [],
    info: {
      all: 0,
      page: 0,
    }
  } as page,
  actions: {
    get({commit}, page: number) {
      return axios.get<page>(`/api/characters/page/${page}`).then((res) => {
        commit('get', res.data);
        if (res.data.info.page < page || page <= 0) {
          throw Error('要求されたページは存在しません');
        }
      });
    },
    getPageInfo({commit}, page: number) {
      return axios.get<page>('/api/characters/page').then((res) => {
        commit('pageInfo', res.data);
        if (res.data.info.page < page || page <= 0) {
          throw Error('要求されたページは存在しません');
        }
      });
    },
    getOwned({commit}) {
      return axios.get<page>('/api/user/characters').then((res) => {
        commit('get', {characters: res.data});
      });
    },
    reset({commit}) {
      commit('get', {
        characters: []
      });
    }
  },
  mutations: {
    get(state, page: page) {
      Object.assign(state, page);
    },
    pageInfo(state, page: page) {
      state.info = page.info;
    }
  },
} as Module<page, any>;
