document.querySelector('.Faq').addEventListener('click', (e) => {
  const faqHidden = e.target.closest('.Faq__title').querySelector('.Faq__hidden');
  if (faqHidden.style.display === '') {
    faqHidden.style.display = 'flex';
  } else {
    faqHidden.style.display = '';
  }
});
