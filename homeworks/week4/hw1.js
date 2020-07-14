const request = require('request');

request.get(
  'https://lidemy-book-store.herokuapp.com/books',
  (error, response, body) => {
    const content = JSON.parse(body);
    for (let i = 0; i <= 9; i += 1) {
      console.log(`${content[i].id} ${content[i].name}`);
    }
  },
);
