import { Module } from 'vuex';

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
    skills: <skill[]>[
    ],
  } as character,
  actions: {

  },
  mutations: {
    init() {

    },
    insert(state: character, newState: character) {
      Object.assign(state, newState);
    }
  }
} as Module<character, any>
