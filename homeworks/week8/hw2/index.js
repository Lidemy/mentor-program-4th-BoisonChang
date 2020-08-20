const request = new XMLHttpRequest();
const baseUrl = 'https://api.twitch.tv/kraken/streams/';
const errorMessage = '系統不穩定，再試一次';
const gameElement = document.querySelectorAll('.game');

function limitlenghth(str) {
  let newstr = '';
  if (str.length > 16) {
    for (let i = 0; i <= 14; i += 1) {
      newstr += str[i];
    }
    newstr += '...';
  } else {
    newstr = str;
  }
  return newstr;
}

function findnone(str) {
  if (str === '' || str === undefined) {
    // eslint-disable-next-line
    str = 'None';
  }
  return str;
}

function top20game(whichgame) {
  request.addEventListener('load', () => {
    if (request.status >= 200 && request.status <= 400) {
      const response = request.responseText;
      const json = JSON.parse(response);
      for (let i = 0; i < json.streams.length; i += 1) {
        if (i < json.streams.length) {
          const gamePic = json.streams[i].preview.medium;
          const gameIcon = json.streams[i].channel.logo;
          const gameDesc = findnone(limitlenghth(json.streams[i].channel.status));
          const gameAruthor = findnone(json.streams[i].channel.name);
          const gameurl = json.streams[i].channel.url;
          gameElement[i].innerHTML = `<a href="${gameurl}"><img src="${gamePic}" class="game__pic"></a>
              <div class="game_info">
                <img src="${gameIcon}" class="game__icon">
                <div class="gmae__detail">
                  <div class="gmae__detail__name">${gameDesc}</div>
                  <div class="gmae__detail__aurthor">${gameAruthor}</div>
                </div>`;
        }
      }
    } else {
      // eslint-disable-next-line
      alert(errorMessage);
    }
  });
  request.onerror = () => {
    // eslint-disable-next-line
    alert(errorMessage);
  };
  request.open('GET', `${baseUrl}?game=${whichgame}&limit=20`, true);
  request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  request.setRequestHeader('Client-ID', '82f9xqhhwqtobtz3giujrfjjen0tfi');
  request.send();
}

function getGames() {
  const request2 = new XMLHttpRequest();
  let gametype = '';
  request2.addEventListener('load', () => {
    const response = request2.responseText;
    const json = JSON.parse(response);
    gametype = `${encodeURIComponent(json.top[0].game.name)}`;
    top20game(gametype);
    document.querySelector('.page__name').innerText = `${json.top[0].game.name}`;
    for (let i = 0; i < 5; i += 1) {
      document.querySelector(`.game__top${i + 1}`).innerText = `${json.top[i].game.name}`;
      // eslint-disable-next-line
      document.querySelector(`.game__top${i + 1}`).addEventListener('click', () => {
        gametype = `${encodeURIComponent(json.top[i].game.name)}`;
        top20game(gametype);
        document.querySelector('.page__name').innerText = `${json.top[i].game.name}`;
      });
    }
  });
  request2.open('GET', 'https://api.twitch.tv/kraken/games/top?limit=5', true);
  request2.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
  request2.setRequestHeader('Client-ID', '82f9xqhhwqtobtz3giujrfjjen0tfi');
  request2.send();
}

getGames();
