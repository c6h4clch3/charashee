// 再帰処理でn面ダイスをm回振る。
export const mDn = (m: number, n: number): number => {
  if (m < 1) {
    return 0;
  } else {
    return mDn(m - 1, n) + dn(n);
  }
};

// n面ダイスを1回振る。
export const dn = (n: number): number => {
  if (n < 1) {
    return 0;
  }
  return Math.floor(Math.random() * n) + 1;
};
