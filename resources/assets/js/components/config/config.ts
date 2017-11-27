export const params: {
  [key: string]: Parameter
} = {
  'str': {
    name: 'STR',
    dice: 3,
    faces: 6,
    additional: 0
  },
  'con': {
    name: 'CON',
    dice: 3,
    faces: 6,
    additional: 0
  },
  'dex': {
    name: 'DEX',
    dice: 3,
    faces: 6,
    additional: 0
  },
  'pow': {
    name: 'POW',
    dice: 3,
    faces: 6,
    additional: 0,
  },
  'app': {
    name: 'APP',
    dice: 3,
    faces: 6,
    additional: 0,
  },
  'siz': {
    name: 'SIZ',
    dice: 2,
    faces: 6,
    additional: 6,
  },
  'int': {
    name: 'INT',
    dice: 2,
    faces: 6,
    additional: 6,
  },
  'edu': {
    name: 'EDU',
    dice: 3,
    faces: 6,
    additional: 3,
  }
};

export const characterGuard = function(value: any): value is character {
  return (
    (value.id === undefined || typeof value.id === 'number') &&
    (value.user_id === undefined || typeof value.user_id === 'number') &&
    typeof value.name === 'string' &&
    (value.age === null || typeof value.age === 'number') &&
    typeof value.sex === 'string' &&
    typeof value.job === 'string' &&
    typeof value.str === 'number' &&
    typeof value.con === 'number' &&
    typeof value.dex === 'number' &&
    typeof value.pow === 'number' &&
    typeof value.app === 'number' &&
    typeof value.siz === 'number' &&
    typeof value.int === 'number' &&
    typeof value.edu === 'number' &&
    typeof value.comment === 'string' &&
    (value.skills === undefined || (typeof value.skills as string) === 'array') &&
    (value.tags === undefined || (typeof value.tags as string) === 'array')
  );
};
