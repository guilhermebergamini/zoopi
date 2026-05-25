<?php

class LojaController extends Controller
{
    public function index(): void
    {
        $this->view('lojas/index', [
            'titulo' => 'Lojas',
            'lojas' => $this->model('Loja')->todas(),
        ]);
    }

    public function create(): void
    {
        $this->view('lojas/create', ['titulo' => 'Cadastrar Loja']);
    }

    public function store(): void
    {
        $this->model('Loja')->criar([
            'razao_social' => $this->input('razao_social'),
            'nome_fantasia' => $this->input('nome_fantasia'),
            'cnpj' => $this->input('cnpj'),
            'inscricao_estadual' => $this->input('inscricao_estadual'),
            'endereco' => $this->input('endereco'),
            'telefone' => $this->input('telefone'),
            'email' => $this->input('email'),
            'imagem' => $this->uploadImagem('imagem'),
        ]);
        $this->flash('success', 'Loja cadastrada com sucesso.');
        $this->redirect('/lojas');
    }

    public function delete(): void
    {
        $this->model('Loja')->excluir((int) $this->input('id'));
        $this->flash('success', 'Loja inativada.');
        $this->redirect('/lojas');
    }
}
