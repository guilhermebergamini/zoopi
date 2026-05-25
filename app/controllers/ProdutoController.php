<?php

class ProdutoController extends Controller
{
    public function index(): void
    {
        $this->view('produtos/index', [
            'titulo' => 'Produtos',
            'produtos' => $this->model('Produto')->todos(),
        ]);
    }

    public function create(): void
    {
        $this->view('produtos/create', $this->formDados());
    }

    public function store(): void
    {
        $this->model('Produto')->criar($this->dadosProduto());
        $this->flash('success', 'Produto cadastrado com sucesso.');
        $this->redirect('/produtos');
    }

    public function show(): void
    {
        $produto = $this->model('Produto')->buscar((int) ($_GET['id'] ?? 0));
        $this->view('produtos/show', ['titulo' => 'Produto', 'produto' => $produto]);
    }

    public function edit(): void
    {
        $dados = $this->formDados();
        $dados['produto'] = $this->model('Produto')->buscar((int) ($_GET['id'] ?? 0));
        $this->view('produtos/edit', $dados);
    }

    public function update(): void
    {
        $id = (int) $this->input('id');
        $produtoAtual = $this->model('Produto')->buscar($id);
        $dados = $this->dadosProduto();
        $dados['imagem'] = $dados['imagem'] ?: ($produtoAtual['prod_imagem'] ?? null);
        $this->model('Produto')->atualizar($id, $dados);
        $this->flash('success', 'Produto atualizado com sucesso.');
        $this->redirect('/produtos');
    }

    public function delete(): void
    {
        $this->model('Produto')->excluir((int) $this->input('id'));
        $this->flash('success', 'Produto inativado.');
        $this->redirect('/produtos');
    }

    private function formDados(): array
    {
        return [
            'titulo' => 'Cadastrar Produto',
            'categorias' => $this->model('Categoria')->todas(),
            'lojas' => $this->model('Loja')->ativas(),
        ];
    }

    private function dadosProduto(): array
    {
        return [
            'cat_codigo' => $this->input('cat_codigo'),
            'loj_codigo' => $this->input('loj_codigo'),
            'nome' => $this->input('nome'),
            'fabricante' => $this->input('fabricante'),
            'descricao' => $this->input('descricao'),
            'valor' => str_replace(',', '.', $this->input('valor', 0)),
            'quantidade' => (int) $this->input('quantidade', 0),
            'imagem' => $this->uploadImagem('imagem'),
            'status' => $this->input('status', 'ativo'),
        ];
    }
}
