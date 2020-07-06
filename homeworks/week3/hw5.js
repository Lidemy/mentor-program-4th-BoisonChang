const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function PK(array) {
  const rule = Number(array[2]);
  if (rule === 1) {
    // eslint-disable-next-line
    console.log((array[0] >= array[1]) ? (array[0] === array[1] ? 'DRAW' : 'A') : 'B');
    return;
  }
  if (rule === -1) {
    // eslint-disable-next-line
    console.log((array[0] <= array[1]) ? (array[0] === array[1] ? 'DRAW' : 'A') : 'B');
  }
}

function solve(input) {
  for (let i = 0; i <= input.length - 1; i += 1) {
    PK(input[i].split(' '));
  }
}

rl.on('close', () => {
  solve(lines);
});
