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
    } as user,
    isCreate: true,
    skillsets: [] as skillset[],
    skills: [] as skill[],
  },
  actions: {
    getUser({commit}) {
      return axios.get<user>('/api/user').then((res) => {
        commit('user', res.data);
        return res;
      });
    },
    updateIsCreate({commit}, value: boolean) {
      commit('updateIsCreate', value);
    },
    getSkillsets({commit}) {
      return axios.get<skillset[]>('/api/skillsets').then((res) => {
        commit('skillsets', res.data);
        return res;
      });
    },
    getSkills({commit}) {
      return axios.get<skill[]>('/api/skills').then((res) => {
        commit('skills', res.data);
        return res;
      });
    }
  },
  mutations: {
    user(state, user: user) {
      state.user.id = user.id;
      state.user.name = user.name;
      state.user.email = user.email;
    },
    updateIsCreate(state, value: boolean) {
      state.isCreate = value;
    },
    skillsets(state, skillsets: skillset[]) {
      state.skillsets = skillsets;
    },
    skills(state, skills: skill[]) {
      state.skills = skills;
    }
  },
  modules: {
    character,
    characterList,
  },
});
