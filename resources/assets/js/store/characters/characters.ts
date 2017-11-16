import { Module } from 'vuex';
import axios, { AxiosPromise } from 'axios';

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
      const request = axios.get(
        `/api/characters/${id}`
      ) as AxiosPromise<character>;

      request.then((character) => {
        commit('insert', character.data);
      }).catch((reason) => {
        throw Error(reason);
      });
    },
    input({commit, dispatch, rootState}, character: character) {
      let promise: Promise<character>;
      if (rootState.character_id === undefined) {
        promise = dispatch('create', character);
      } else {
        promise = dispatch('update', {
          id: rootState.character_id,
          character: character,
        });
      }
      promise.then((val: character) => {
        commit('insert', character)
      });
    },
    create({}, character: character): Promise<character> {
      return new Promise<character>((res, rej) => {
        const request =
          axios.post(
            '/api/characters/create',
            character
          ) as AxiosPromise<character>;

        request.then((character) => {
          res(character.data);
        }).catch((res) => {
          throw new Error(res);
        });
      });
    },
    update({}, data: {
      id: number,
      character: character
    }) {
      return new Promise<character>((res, rej) => {
        const request =
          axios.post(
            `/api/characters/update/${data.id}`,
            data.character
          ) as AxiosPromise<character>;

        request.then((character) => {
          res(character.data);
        }).catch((res) => {
          throw new Error(res);
        });
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
    insert(state: character, newState: character) {
      state = Object.assign(state, newState) as character;
    }
  },
} as Module<character, any>