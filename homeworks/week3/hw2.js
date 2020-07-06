const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});


function solve(input) {
  const temp = input[0].split(' ');
  const N = Number(temp[0]);
  const M = Number(temp[1]);

  function Digits(which) {
    for (let j = 1; j <= 6; j += 1) {
      if (which === 0) {
        return 0;
      }
      if (Math.floor(which / (10 ** j)) === 0) {
        return j;
      }
    }
  }
  function POWSUM(which, D) {
    let str = 0;
    let n = which;
    let x = 0;
    let y = 0;
    for (let i = 1; i <= D; i += 1) {
      x = Math.floor(n % (10 ** 1));
      y = x ** D;
      str += y;
      n /= 10;
    }
    if (str === which) {
      console.log(`${which}`);
    }
  }

  function isNarNumber(a, b) {
    let i = a;
    for (i; i <= b; i += 1) {
      POWSUM(i, Digits(i));
    }
  }
  isNarNumber(N, M);
}

rl.on('close', () => {
  solve(lines);
});
