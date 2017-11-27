import { Module } from 'vuex';
import axios, { AxiosPromise } from 'axios';
import * as _ from 'lodash';
import { mDn } from '../../components/utils/mdn';
import { params } from '../../components/config/config';

export default {
  namespaced: true,
  state: {
    name: '',
    age: null,
    sex: '',
    job: '',
    str: 0,
    con: 0,
    dex: 0,
    pow: 0,
    app: 0,
    siz: 0,
    int: 0,
    edu: 0,
    hp: 0,
    hp_additional: 0,
    mp: 0,
    mp_additional: 0,
    san: 0,
    mythos_skill: 0,
    comment: '',
    skills: [] as Array<skill>,
    tags: [] as Array<string>
  } as character,
  actions: {
    init({commit}) {
      commit('init');
    },
    get({commit}, id: number) {
      axios.get<character>(
        `/api/characters/${id}`
      ).then((character) => {
        commit('insert', character.data);
      }).catch((reason) => {
        throw Error(reason);
      });
    },
    input({commit}, character: character) {
      commit('insert', character);
    },
    post({commit, dispatch}, data: {
      id: string|number|undefined,
      character: character
    }) {
      let promise: Promise<character>;
      if (data.id === undefined) {
        promise = dispatch('create', data.character);
      } else {
        promise = dispatch('update', {
          id: data.id,
          character: data.character,
        });
      }
      promise.then((val: character) => {
        commit('insert', val);
      });
    },
    create({}, character: character): Promise<character> {
      return axios.post<character>(
        '/api/characters/create',
        {character:character}
      ).then((character) => {
        return character.data;
      }).catch((res: any) => {
        throw new Error(res);
      });
    },
    update({}, data: {
      id: number|string,
      character: character
    }): Promise<character> {
      return axios.post<character>(
        `/api/characters/update/${data.id}`,
        data.character
      ).then((character) => {
        return character.data;
      }).catch((res: any) => {
        throw new Error(res);
      });
    },
    delete({}, id: number|string): Promise<any> {
      return axios.post(`/api/characters/delete/${id}`);
    },
    updateParam({commit}, item: {
      key: number,
      value: any,
    }) {
      commit('updateParam', item);
    },
    rollAll({commit}) {
      commit('rollAll');
    },
    roll({commit}, key: string) {
      commit('roll', key);
    }
  },
  mutations: {
    init(state: character) {
      Object.assign(state, {
        name: '',
        age: null,
        sex: '',
        job: '',
        str: 0,
        con: 0,
        dex: 0,
        pow: 0,
        app: 0,
        siz: 0,
        int: 0,
        edu: 0,
        hp: 0,
        hp_additional: 0,
        mp: 0,
        mp_additional: 0,
        san: 0,
        mythos_skill: 0,
        comment: '',
        skills: [] as Array<skill>,
        tags: [] as Array<string>,
      } as character);
    },
    insert(state: character, newState: character) {
      state = Object.assign(state, newState) as character;
    },
    updateParam(state: character, item: {
      key: string,
      value: any
    }) {
      _.set(state, item.key, item.value);
      if (item.key === 'con' || item.key === 'siz') {
        state.hp = (state.con + state.siz)/2;
      }
      if (item.key === 'pow') {
        state.mp = state.pow;
      }
      if (item.key === 'mythos_skill') {
        state.san = Math.min(state.san, 99 - state.mythos_skill);
      }
    },
    addSkills(state: character, skills: skill[]) {
      state.skills.push(...skills);
    },
    removeSkill(state: character, target: number) {
      _.remove(state.skills, (value, index) => {
        return index === target;
      })
    },
    rollAll(state: character) {
      _.map(params, function (param, key) {
        _.set(state, key, mDn(param.dice, param.faces) + param.additional);
      });
      state.hp = (state.con + state.siz) / 2;
      state.mp = state.pow;
      state.san = state.pow * 5 - state.mythos_skill;
    },
    roll(state: character, key: string) {
      const dice = params[key].dice;
      const faces = params[key].faces;
      const additional = params[key].additional;

      _.set(state, key, mDn(dice, faces) + additional);

      if (key === 'con' || key === 'siz') {
        state.hp = (state.con + state.siz) / 2;
      }
      if (key === 'pow') {
        state.mp = state.pow;
        state.san = state.pow * 5 - state.mythos_skill;
      }
    }
  },
} as Module<character, any>
