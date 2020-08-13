const input = document.querySelector('.todo__name');
const tdl = document.querySelector('.todolists');

input.addEventListener('keydown', (e) => {
  const content = document.querySelector('.todolists');
  const newitem = document.createElement('div');
  if (e.keyCode === 13) {
    newitem.innerHTML = `<input class='todolist tdi__status' type='checkbox'>
            <p class='todolist tdi__item'>
              <span class='todolist__todo'>${input.value}</span>
            </p>
            <button class='todolist tdi__btns'>刪除</button>`;
    newitem.classList.add('todolist__row');
    content.appendChild(newitem);
    input.value = '';
  }
});

tdl.addEventListener('click', (e) => {
  if (e.target.classList.contains('tdi__btns')) {
    document.querySelector('.todolists').removeChild(e.target.closest('.todolist__row'));
  }
});

tdl.addEventListener('click', (e) => {
  const checkbox = e.target.closest('.todolist__row').querySelector('.todolist__todo');
  if (e.target.classList.contains('tdi__status')) {
    checkbox.classList.toggle('todolist__done');
  }
});
