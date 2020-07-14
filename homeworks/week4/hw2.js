const request = require('request');
const process = require('process');

request.get(
  'https://lidemy-book-store.herokuapp.com/books/',
  (error, response, body) => {
    const content = JSON.parse(body);
    if (process.argv[2] === 'list') {
      for (let i = 0; i <= content.length - 1; i += 1) {
        console.log(`${content[i].id} ${content[i].name}`);
      }
    }
    if (process.argv[2] === 'read' && process.argv[3] >= 0 && process.argv[3] <= content.length - 1) {
      console.log(content[process.argv[3]].name);
    }
  },
);

if (process.argv[2] === 'delete') {
  request.delete(
    {
      method: 'DELETE',
      url: `https://lidemy-book-store.herokuapp.com/books/+${process.argv[3]}`,
    },
  );
}

if (process.argv[2] === 'create') {
  request.post(
    {
      url: 'https://lidemy-book-store.herokuapp.com/books/',
      form: {
        name: `${process.argv[3]}`,
      },
    },
    (error, response, body) => {
      console.log(body);
    },
  );
}

if (process.argv[2] === 'update') {
  request.patch({
    url: `https://lidemy-book-store.herokuapp.com/books/+${process.argv[3]}`,
    form: {
      name: `${process.argv[4]}`,
    },
  },
  (error, response, body) => {
    console.log(JSON.parse(body));
  });
}
