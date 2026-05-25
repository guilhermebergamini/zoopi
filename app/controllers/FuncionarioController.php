<?php

class FuncionarioController extends Controller
{
    public function index(): void
    {
        $this->view('funcionarios/index', [
            'titulo' => 'Funcionarios',
            'funcionarios' => $this->model('Funcionario')->todos(),
        ]);
    }

    public function create(): void
    {
        $this->view('funcionarios/create', ['titulo' => 'Cadastrar Funcionario']);
    }

    public function store(): void
    {
        $this->model('Funcionario')->criar([
            'nome' => $this->input('nome'),
            'sobrenome' => $this->input('sobrenome'),
            'cpf' => $this->input('cpf'),
            'data_nascimento' => $this->input('data_nascimento'),
            'telefone' => $this->input('telefone'),
            'cargo' => $this->input('cargo'),
            'salario' => str_replace(',', '.', $this->input('salario')),
            'email' => $this->input('email'),
            'senha' => $this->input('senha'),
            'imagem' => $this->uploadImagem('imagem'),
        ]);
        $this->flash('success', 'Funcionario cadastrado com sucesso.');
        $this->redirect('/funcionarios');
    }

    public function delete(): void
    {
        $this->model('Funcionario')->excluir((int) $this->input('id'));
        $this->flash('success', 'Funcionario inativado.');
        $this->redirect('/funcionarios');
    }
}
