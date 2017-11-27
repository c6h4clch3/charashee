declare interface character {
  [key: string]: string|number|null|Array<skill|string>|undefined|boolean;
  id?: number;
  user_id?: number;
  name: string;
  age: number|null;
  sex: string;
  job: string;
  str: number;
  con: number;
  dex: number;
  pow: number;
  app: number;
  siz: number;
  int: number;
  edu: number;
  hp: number;
  hp_additional: number;
  mp: number;
  mp_additional: number;
  san: number;
  mythos_skill: number;
  comment: string;
  skills: Array<skill>;
  tags: Array<string>;
}
