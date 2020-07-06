const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

// 超過 16 位數的比較，則取 Sting 後一位數一位數比大小
function BiGPK(A, B, what) {
  let SA = A;
  let SB = B;
  // 若是比小，則把 SA 和 SB 的值交換
  if (Number(what) === -1) {
    SB = A;
    SA = B;
  }

  let i = 0;
  // 若位數大於 B，則輸出
  if (SA.length > SB.length) {
    console.log('A');
    return;
  }
  // 若位數大於 A，則輸出
  if (SA.length < SB.length) {
    console.log('B');
    return;
  }
  if (SA.length === SB.length) {
    while (i <= SA.length - 1) {
      if (SA[i] > SB[i]) {
        console.log('A');
        return;
      }
      if (SA[i] < SB[i]) {
        console.log('B');
        return;
      }
      i += 1;
    } console.log('DRAW');
  }
}

function PK(array) {
  // 比大小
  const rule = Number(array[2]);
  const A = Number(array[0]);
  const B = Number(array[1]);
  if (Math.log10(A) > 16 || Math.log10(B) > 16) {
    BiGPK(array[0], array[1], rule);
    return;
  }
  if (rule === 1) {
    // 正常情況，要比「大」則用三元巢狀比完
    // eslint-disable-next-line
    console.log((A >= B) ? (A === B ? 'DRAW' : 'A') : 'B');
    return;
  }
  if (rule === -1) {
    // 正常情況，要比「小」則用三元巢狀比完
    // eslint-disable-next-line
    console.log((A <= B) ? (A === B ? 'DRAW' : 'A') : 'B');
  }
}


function solve(input) {
  for (let i = 1; i <= input.length - 1; i += 1) {
    PK(input[i].split(' '));
  }
}

rl.on('close', () => {
  solve(lines);
});
