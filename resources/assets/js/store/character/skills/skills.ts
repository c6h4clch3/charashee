import { Module } from 'vuex';
import * as _ from 'lodash';
import axios from 'axios';

const format = function(obj: skill): {
  name: any,
  init: any,
  reference: any
} {
  return {
    name: obj.name,
    init: obj.init,
    reference: obj.reference,
  }
};

let duplicates: number[] = [];

export default {
  namespaced: true,
  state: [] as skill[],
  getters: {
    all(state): skill[] {
      return state;
    },
    isUnique(state): boolean {
      duplicates = [];
      return !_.reduce<skill, boolean>(state, function(res: boolean, val, key) {
        return _.reduce<skill, boolean>(_.slice(state, key+1), function(temp: boolean, othVal, othKey) {
          const isMatch = _.isMatch(val, format(othVal));
          if (isMatch) {
            if (duplicates.length === 0) {
              // 初めての重複
              duplicates.push(key);
            }
            duplicates.push(othKey);
          }
          return isMatch || res;
        }, false) || res;
      }, false);
    },
    sumOfJob(state): number {
      return _.reduce<skill, number>(state, function(res: number, val) {
        return res + val.job_point;
      }, 0);
    },
    sumOfInterest(state): number {
      return _.reduce<skill, number>(state, function(res: number, val) {
        return res + val.interest_point;
      }, 0);
    },
    duplicates(state): number[] {
      return duplicates;
    }
  },
  actions: {
    uniquefy({commit}) {
      commit('uniquefy');
    },
    push({commit}, skill: skill) {
      commit('push', skill);
    },
    replaceBySkillset({commit}, id) {
      return axios.get<skillset>(`/api/skillsets/${id}`).then((res) => {
        commit('replace', res.data.skills as skill[]);
      });
    }
  },
  mutations: {
    uniquefy(state) {
      state = _.uniqWith(state, function(arrVal, othVal): boolean {
        return _.isEqual(format(arrVal), format(othVal));
      });
    },
    push(state, skill: skill) {
      state.push(skill);
    },
    replace(state, skills: skill[]) {
      state = skills;
    }
  }
} as Module<skill[], any>;
