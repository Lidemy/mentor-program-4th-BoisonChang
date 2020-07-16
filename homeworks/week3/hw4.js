const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  const str = input[0];
  let restr = [];
  for (let i = str.length - 1; i >= 0; i -= 1) {
    restr += str[i];
  }
  if (restr === str) {
    console.log('True');
  } else {
    console.log('False');
  }
}

rl.on('close', () => {
  solve(lines);
});
