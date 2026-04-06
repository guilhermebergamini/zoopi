// produto.js — Xhopii Product Page

const images = [
  '/src/assets/images/produto1.png',
  '/src/assets/images/produto2.png',
  '/src/assets/images/produto3.png',
  '/src/assets/images/produto4.png',
  '/src/assets/images/produto5.png'
];

const colorBtns    = document.querySelectorAll('.btn-cor');
const sizeBtns     = document.querySelectorAll('.btn-tam');
const thumbs       = document.querySelectorAll('.thumb');
const mainImage    = document.getElementById('mainImage');
const tamanhoLabel = document.getElementById('tamanhoLabel');

function selectProduct(index) {
  mainImage.src = images[index];

  thumbs.forEach(t => t.classList.remove('active'));
  thumbs[index].classList.add('active');

  colorBtns.forEach(b => b.classList.remove('active'));
  colorBtns[index].classList.add('active');
}

colorBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    selectProduct(parseInt(btn.dataset.index));
  });
});

thumbs.forEach((thumb) => {
  thumb.addEventListener('click', () => {
    selectProduct(parseInt(thumb.dataset.index));
  });
});

sizeBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    sizeBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    tamanhoLabel.textContent = 'Tamanho Selecionado: ' + btn.dataset.size;
  });
});