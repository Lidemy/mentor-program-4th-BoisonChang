const input = document.querySelectorAll('.question__answer');

document.addEventListener('submit', (e) => {
  let i = 0;
  let checkEmpty = 0;
  const type1 = document.querySelector('.Type1').checked;
  const type2 = document.querySelector('.Type2').checked;
  const typeWarn = document.querySelector('.Type1').closest('.question__content').querySelector('.answer__warn');
  for (i; i <= 3; i += 1) {
    const answerWarn = input[i].closest('.question__content').querySelector('.answer__warn');
    if (input[i].value === '') {
      answerWarn.style.display = 'flex';
    } else {
      answerWarn.style.display = 'none';
      checkEmpty += 1;
    }
    e.preventDefault();
  }
  if (!(type1 || type2)) {
    typeWarn.style.display = 'flex';
  } else {
    typeWarn.style.display = 'none';
    checkEmpty += 1;
  }
  if (checkEmpty === 5) {
    // eslint-disable-next-line
    alert('成功送出表單');
  }
});
