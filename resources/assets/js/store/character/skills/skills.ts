import { Module } from 'vuex';
import * as _ from 'lodash';
import axios from 'axios';

const format = function(obj: skill): {
  name: string,
  init: number,
  reference: string|null,
} {
  return {
    name: obj.name,
    init: obj.init,
    reference: obj.reference,
  }
};

let duplicates: number[] = [];
function getUnique(state: skill[]): boolean {
  duplicates = [];
  return !_.reduce<skill, boolean>(state, function(res: boolean, val, key) {
    return (_.reduce<skill, boolean>(_.slice(state, key+1), function(temp: boolean, othVal, othKey) {
      const isMatch = _.isMatch(format(val), format(othVal));
      if (isMatch) {
        if (duplicates.length === 0) {
          // 初めての重複
          duplicates.push(key);
        }
        duplicates.push(othKey);
      }
      return (isMatch || temp);
    }, false) || res);
  }, false);
}

let counter = 0;

export default {
  namespaced: true,
  state: [] as skill[],
  getters: {
    all(state): skill[] {
      return state;
    },
    isUnique(state): boolean {
      return getUnique(state);
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
      getUnique(state);
      return duplicates;
    }
  },
  actions: {
    uniquefy({commit}) {
      commit('uniquefy');
    },
    push({commit}, skill: skill) {
      commit('push', skill);
      commit('withKey');
    },
    init({commit}) {
      commit('withKey');
    },
    pushByArray({commit}, skills: skill[]) {
      commit('pushArray', _.map(skills, function(skill: skill) {
        return Object.assign({
          key: counter++,
          job_point: 0,
          interest_point: 0,
          others_point: 0,
        }, skill);
      }));
    },
    pushBySkillset({commit}, id) {
      return axios.get<skillset>(`/api/skillsets/${id}`).then((res) => {
        commit('pushArray', _.map(res.data.skills as skill[], function(skill: skill) {
          return Object.assign({
            key: counter++,
            job_point: 0,
            interest_point: 0,
            others_point: 0,
          }, skill);
        }));
      });
    },
    unset({commit}, id: number) {
      commit('unset', id);
    },
    update({commit}, item: { id: number, skill: skill }) {
      commit('update', item);
    }
  },
  mutations: {
    uniquefy(state) {
      state = _.uniqWith(state, function(arrVal, othVal): boolean {
        return _.isEqual(format(arrVal), format(othVal));
      });
    },
    withKey(state) {
      state = _.map(state, (skill) => {
        return Object.assign(skill, Object.assign({
          key: counter++,
        }, skill)) as skill;
      });
    },
    push(state, skill: skill) {
      state.push(skill);
    },
    pushArray(state, skills: skill[]) {
      state.push(...skills);
    },
    replace(state, skills: skill[]) {
      state = _.map(skills, function(skill) {
        return Object.assign({
          key: counter++,
          job_point: 0,
          interest_point: 0,
          others_point: 0,
        }, skill) as skill;
      });
    },
    unset(state, id: number) {
      state.splice(id, 1);
    },
    update(state, item: { id: number, skill: skill }) {
      state.splice(item.id, 1, item.skill);
    }
  }
} as Module<skill[], any>;
