const request = require('request');

request.get(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    let content;
    try {
      content = JSON.parse(body);
    } catch (exception) {
      console.log(exception); // 錯誤處理
    }
    for (let i = 0; i <= content.length - 1; i += 1) {
      console.log(`${content[i].id} ${content[i].name}`);
    }
  },
);
