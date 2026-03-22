const produtos = [
  {
    id: 1,
    nome: "Fone Bluetooth",
    preco: 89.90,
    imagem: "assets/fone.jpg"
  },
  {
    id: 2,
    nome: "Teclado Mecânico",
    preco: 199.90,
    imagem: "assets/teclado.jpg"
  },
  {
    id: 3,
    nome: "Mouse Gamer",
    preco: 129.90,
    imagem: "assets/mouse.jpg"
  },
  {
    id: 4,
    nome: "Monitor 24\"",
    preco: 899.90,
    imagem: "assets/monitor.jpg"
  }
];

function pegarIdUrl() {
  const params = new URLSearchParams(window.location.search);
  return parseInt(params.get("id"));
}

function carregarProduto() {
  const id = pegarIdUrl();
  const produto = produtos.find(p => p.id === id);

  const container = document.getElementById("produto-detalhe");

  container.innerHTML = `
    <img src="${produto.imagem}">
    <h1>${produto.nome}</h1>
    <p class="preco">R$ ${produto.preco.toFixed(2)}</p>
    <button onclick="adicionarCarrinho(${produto.id})">Adicionar ao Carrinho</button>
  `;
}

carregarProduto();