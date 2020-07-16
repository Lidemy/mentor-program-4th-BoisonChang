const request = require('request');
const process = require('process');

request.get(
  `https://restcountries.eu/rest/v2/name/${process.argv[2]}`,
  (error, response, body) => {
    let content;
    try {
      content = JSON.parse(body);
    } catch (exception) {
      console.log(exception); // 錯誤處理
    }
    if (!(response.statusCode >= 200 && response.statusCode < 300)) {
      console.log(' 找不到國家資訊 ');
      return;
    }

    console.log(content);

    for (let i = 0; i <= content.length - 1; i += 1) {
      console.log('============');
      console.log(`國家：${content[i].name ? content[i].name : '無資料'}`);
      console.log(`首都：${content[i].capital ? content[i].capital : '無資料'}`);
      console.log(`貨幣：${content[i].currencies[0].code ? content[i].currencies[0].code : '無資料'}`);
      console.log(`國碼：${content[i].callingCodes ? content[i].callingCodes : '無資料'}`);
    }
  },
);
