const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  const star = input[0];
  for (let i = 1; i <= star; i += 1) {
    let str = '';
    for (let j = 1; j <= i; j += 1) {
      str += '*';
    }
    console.log(str);
  }
}

rl.on('close', () => {
  solve(lines);
});
