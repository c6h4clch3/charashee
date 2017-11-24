export const params: { [key: string]: string } = {
  'str': 'STR',
  'con': 'CON',
  'dex': 'DEX',
  'pow': 'POW',
  'app': 'APP',
  'siz': 'SIZ',
  'int': 'INT',
  'edu': 'EDU',
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
