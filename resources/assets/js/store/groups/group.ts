import { Module } from 'vuex';
import axios, { AxiosPromise, AxiosResponse } from 'axios';

const _default: Module<group, AppStore> = {
  namespaced: true,
  state: {
    id: undefined,
    name: '',
    description: '',
    characters: [] as character[],
  } as group,
  actions: {
    init({ commit }) {
      commit('replace', {
        id: undefined,
        name: '',
        description: '',
        characters: [] as character[],
      });
    },
    insert({ commit }, value: group) {
      commit('replace', value);
    },
    async get({ commit }, id: number) {
      commit('replace', (await axios.get<group>(`/api/groups/${id}`)).data);
    },
    async getOwned({ commit }, id: number) {
      commit('replace', (await axios.get<group>(
        `/api/groups/owner-only/${id}`
      )).data);
    },
    async post({ commit, dispatch }, item: group) {
      let response: AxiosResponse<group>;
      if (item.id !== undefined) {
        response = await dispatch('update', item);
      } else {
        response = await dispatch('create', item);
      }

      commit('replace', response.data);
      return response.data;
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
    addCharacterToGroup({commit}, item: {
      groupId: number,
      characterId: number,
    }) {
      return axios.post(
        `/api/groups/${item.groupId}/add`,
        {
          character_id: item.characterId,
        }
      ).then((res) => {
        commit('replace', res.data);
      });
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
};

export default _default;
