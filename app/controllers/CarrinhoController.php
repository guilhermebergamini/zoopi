<?php

class CarrinhoController extends Controller
{
    public function index(): void
    {
        $clienteId = $this->clienteLogado();
        $carrinho = $this->model('Carrinho');
        $this->view('carrinho/index', [
            'titulo' => 'Carrinho',
            'itens' => $carrinho->itens($clienteId),
            'total' => $carrinho->total($clienteId),
        ]);
    }

    public function adicionar(): void
    {
        $clienteId = $this->clienteLogado();
        $produto = $this->model('Produto')->buscar((int) $this->input('produto_id'));

        if ($produto) {
            $this->model('Carrinho')->adicionar($clienteId, $produto, max(1, (int) $this->input('quantidade', 1)));
            $this->flash('success', 'Produto adicionado ao carrinho.');
        }

        $this->redirect('/carrinho');
    }

    public function remover(): void
    {
        $this->model('Carrinho')->remover((int) $this->input('id'), $this->clienteLogado());
        $this->redirect('/carrinho');
    }

    private function clienteLogado(): int
    {
        if (empty($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
            $this->flash('danger', 'Faca login como cliente para acessar o carrinho.');
            $this->redirect('/login');
        }

        return (int) $_SESSION['usuario']['id'];
    }
}
