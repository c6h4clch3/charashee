import { Module } from 'vuex';
import axios, { AxiosPromise } from 'axios';

export default {
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
    mp: 0,
    san: 0,
    comment: '',
    skills: [
    ] as Array<skill>,
  } as character,
  actions: {
    init({commit}) {
      commit('init');
    },
    get({commit}, id: number) {
      const request = axios.get(`/api/characters/${id}`) as AxiosPromise<character>;
      request.then((character) => {
        commit('get', character.data);
      }).catch((reason) => {
        throw Error(reason);
      });
    }
  },
  mutations: {
    init(state: character) {
      state = {
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
        mp: 0,
        san: 0,
        comment: '',
        skills: [
        ] as Array<skill>,
      } as character;
    },
    get(state: character, newState: character) {
      state = Object.assign(state, newState) as character;
    }
  },
} as Module<character, any>
