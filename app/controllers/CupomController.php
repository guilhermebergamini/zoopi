<?php

class CupomController extends Controller
{
    public function index(): void
    {
        $this->view('cupons/index', [
            'titulo' => 'Cupons',
            'cupons' => $this->model('Cupom')->todos(),
        ]);
    }

    public function create(): void
    {
        $this->view('cupons/create', ['titulo' => 'Cadastrar Cupom']);
    }

    public function store(): void
    {
        $this->model('Cupom')->criar([
            'codigo' => $this->input('codigo'),
            'descricao' => $this->input('descricao'),
            'tipo' => $this->input('tipo'),
            'valor' => str_replace(',', '.', $this->input('valor')),
            'valor_minimo' => str_replace(',', '.', $this->input('valor_minimo')),
            'quantidade' => (int) $this->input('quantidade'),
            'validade' => $this->input('validade'),
        ]);
        $this->flash('success', 'Cupom cadastrado com sucesso.');
        $this->redirect('/cupons');
    }

    public function delete(): void
    {
        $this->model('Cupom')->excluir((int) $this->input('id'));
        $this->flash('success', 'Cupom inativado.');
        $this->redirect('/cupons');
    }
}
