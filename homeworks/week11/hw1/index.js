const btn = document.querySelector('.board__btn-nickname');
btn.addEventListener('click', () => {
  const form = document.querySelector('.board__title-edit');
  form.classList.toggle('hide');
});
