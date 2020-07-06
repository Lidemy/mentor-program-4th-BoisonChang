const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});


function isPrime(number) {
  let i = 2;
  if (number === 1) {
    console.log('Composite');
    return;
  }
  if (number === 2) {
    console.log('Prime');
    return;
  }
  while (i < number) {
    if (number % i === 0) {
      console.log('Composite');
      return;
    }
    i += 1;
  }
  console.log('Prime');
}


function solve(input) {
  const N = input[0];
  for (let i = 1; i <= N; i += 1) {
    isPrime(Number(input[i]));
  }
}

rl.on('close', () => {
  solve(lines);
});
