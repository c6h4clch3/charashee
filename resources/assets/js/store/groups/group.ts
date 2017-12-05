import { Module } from 'vuex';
import axios, { AxiosPromise } from 'axios';

export default {
  namespaced: true,
  state: {
    id: undefined,
    name: '',
    description: '',
    characters: [] as character[],
  } as group,
  actions: {
    get({ commit }, id: number) {
      return axios.get<group>(`/api/groups/${id}`).then((res) => {
        commit('replace', res.data);
      });
    },
    post({ commit, dispatch }, item: group) {
      let request: AxiosPromise<group>;
      if (item.id !== undefined) {
        request = dispatch('update', item);
      } else {
        request = dispatch('create', item);
      }

      return request.then((res) => {
        commit('replace', res.data);
      });
    },
    create({ commit }, item: group) {
      return axios.post<group>(
        '/api/groups/create',
        item
      );
    },
    update({ commit }, item: group) {
      return axios.post<group>(
        `/api/groups/update/${item.id}`,
        item
      );
    },
    delete({ dispatch }, id: number) {
      return axios.delete(
        `/api/groups/delete/${id}`
      );
    },
    removeCharacterFromGroup({ state }, characterId: number) {
      return axios.post(
        `/api/groups/${state.id}/remove`,
        {
          character_id: characterId,
        }
      ).then(() => {
        return true;
      });
    }
  },
  mutations: {
    replace(state, value: group) {
      Object.assign(state, value);
    },
  },
  getters: {},
} as Module<group, any>;
