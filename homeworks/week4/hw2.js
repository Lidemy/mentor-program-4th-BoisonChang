const request = require('request');
const process = require('process');

const args = process.argv;
const BASEURL = 'https://lidemy-book-store.herokuapp.com';

const action = args[2];
const params = args[3];

function TryError(str) {
  let content;
  try {
    content = JSON.parse(str);
    return content;
  } catch (exception) {
    console.log(exception); // 錯誤處理
  }
}

function listbook() {
  request.get(
    `${BASEURL}/books/`, (error, response, body) => {
      const content = TryError(body);
      if (error) {
        return console.log('抓取失敗', error);
      }
      for (let i = 0; i <= content.length - 1; i += 1) {
        console.log(`${content[i].id} ${content[i].name}`);
      } return error;
    },
  );
}

function readbook(id) {
  request.get(
    `${BASEURL}/books/`, (error, response, body) => {
      const content = TryError(body);
      if (error) {
        return console.log('讀取失敗', error);
      }
      console.log(content[id].name);
      return error;
    },
  );
}

function deletebook(id) {
  request.delete(
    `${BASEURL}/books/${id}`, (error) => {
      if (error) {
        return console.log('刪除失敗', error);
      }
      console.log('刪除成功');
      return error;
    },
  );
}

function createbook(name) {
  request.post({
    url: `${BASEURL}/books/`,
    form: {
      name,
    },
  }, (error) => {
    if (error) {
      return console.log('新增失敗', error);
    }
    console.log('新增成功！');
    return error;
  });
}

function updatebook(id, name) {
  request.patch({
    url: `${BASEURL}/books/${id}`,
    form: {
      name,
    },
  }, (error) => {
    if (error) {
      return console.log('更新失敗', error);
    }
    console.log('更新成功！');
    return error;
  });
}

switch (action) {
  case 'list':
    listbook();
    break;
  case 'read':
    readbook(params);
    break;
  case 'delete':
    deletebook(params);
    break;
  case 'create':
    createbook(params);
    break;
  case 'update':
    updatebook(params, args[4]);
    break;
  default:
    console.log('請重新輸入正確指令');
}
