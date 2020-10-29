const baseUrl = 'https://api.twitch.tv/kraken/';
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

function findNone(str) {
  if (str === '' || str === undefined) {
    // eslint-disable-next-line
    str = 'None';
  }
  return str;
}

function getTop20Game(gameName) {
  fetch(`${baseUrl}streams/?game=${gameName}&limit=20`, {
    method: 'GET',
	headers: {
	  'Accept': 'application/vnd.twitchtv.v5+json',
	  'Client-ID': '82f9xqhhwqtobtz3giujrfjjen0tfi'
	}
  }).then(response => {
    return response.json();
  }).then(data => {
    console.log(data);
    for (let i = 0; i < data.streams.length; i += 1) {
      if (i < data.streams.length) {
        const gamePic = data.streams[i].preview.medium;
        const gameIcon = data.streams[i].channel.logo;
        const gameDesc = findNone(limitlenghth(data.streams[i].channel.status));
        const gameAruthor = findNone(data.streams[i].channel.name);
        const gameUrl = data.streams[i].channel.url;
        gameElement[i].innerHTML = `<a href="${gameUrl}"><img src="${gamePic}" class="game__pic"></a>
              <div class="game_info">
                <img src="${gameIcon}" class="game__icon">
                <div class="gmae__detail">
                  <div class="gmae__detail__name">${gameDesc}</div>
                  <div class="gmae__detail__aurthor">${gameAruthor}</div>
                </div>`;
        }
      }
    }).catch(err => {
  	  console.log('err', err);
    }) 
}

function getGames() {
  window.addEventListener('load', () => {
    fetch(`${baseUrl}games/top?limit=5`, {
      method: 'GET',
	  headers: {
	    'Accept': 'application/vnd.twitchtv.v5+json',
	    'Client-ID': '82f9xqhhwqtobtz3giujrfjjen0tfi'
	  }
    }).then(response => {
      return response.json();
    }).then(data => {
      gameInfo = `${encodeURIComponent(data.top[0].game.name)}`;
      getTop20Game(gameInfo);
      document.querySelector('.page__name').innerText = `${data.top[0].game.name}`;
      for (let i = 0; i < 5; i += 1) {
        document.querySelector(`.game__top${i + 1}`).innerText = `${data.top[i].game.name}`;
        // eslint-disable-next-line
        document.querySelector(`.game__top${i + 1}`).addEventListener('click', () => {
          gameInfo = `${encodeURIComponent(data.top[i].game.name)}`;
          getTop20Game(gameInfo);
          document.querySelector('.page__name').innerText = `${data.top[i].game.name}`;
        });
      }
    }).catch(err => {
  	  console.log('err', err);
    }) 
  })
}

getGames();