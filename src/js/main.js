const produtos = [
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
  { nome: "Camisa Desenvolvedor Front-End CSS", preco: "R$ 59,90", estoque: 171, img: "/zoopi/src/assets/images/produto1.png" },
];

function renderProdutos() {
  const lista = document.getElementById("lista-produtos");
  if (!lista) {
    return;
  }

  produtos.forEach(p => {
    lista.innerHTML += `
      <div class="card-produto">
        <img src="${p.img}" alt="${p.nome}">
        <h3>${p.nome}</h3>
        <span class="preco">${p.preco}</span>
        <p>${p.estoque} disponiveis</p>
      </div>
    `;
  });
}

renderProdutos();
