const request = require('request');

const option = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    'Client-ID': '82f9xqhhwqtobtz3giujrfjjen0tfi',
    Accept: 'application/vnd.twitchtv.v5+json',
  },
};

function callback(error, response, body) {
  if (response.statusCode >= 200 && response.statusCode < 300) {
    let info;
    try {
      info = JSON.parse(body);
    } catch (exception) {
      console.log(exception); // 錯誤處理
    }
    for (let i = 0; i <= info.top.length - 1; i += 1) {
      console.log(`${info.top[i].viewers}  ${info.top[i].game.name}`);
    }
  }
}

request(option, callback);
