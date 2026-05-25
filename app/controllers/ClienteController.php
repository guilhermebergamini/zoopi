<?php

class ClienteController extends Controller
{
    public function index(): void
    {
        $this->view('clientes/index', [
            'titulo' => 'Clientes',
            'clientes' => $this->model('Cliente')->todos(),
        ]);
    }

    public function create(): void
    {
        $this->view('clientes/create', ['titulo' => 'Cadastrar Cliente']);
    }

    public function store(): void
    {
        $this->model('Cliente')->criar($this->dadosCliente());
        $this->flash('success', 'Cliente cadastrado com sucesso.');
        $this->redirect('/clientes');
    }

    public function edit(): void
    {
        $this->view('clientes/edit', [
            'titulo' => 'Editar Cliente',
            'cliente' => $this->model('Cliente')->buscar((int) ($_GET['id'] ?? 0)),
        ]);
    }

    public function update(): void
    {
        $id = (int) $this->input('id');
        $atual = $this->model('Cliente')->buscar($id);
        $dados = $this->dadosCliente();
        $dados['imagem'] = $dados['imagem'] ?: ($atual['cli_imagem'] ?? null);
        $dados['status'] = $this->input('status', 'ativo');
        $this->model('Cliente')->atualizar($id, $dados);
        $this->flash('success', 'Cliente atualizado com sucesso.');
        $this->redirect('/clientes');
    }

    public function delete(): void
    {
        $this->model('Cliente')->excluir((int) $this->input('id'));
        $this->flash('success', 'Cliente inativado.');
        $this->redirect('/clientes');
    }

    private function dadosCliente(): array
    {
        return [
            'nome' => $this->input('nome'),
            'sobrenome' => $this->input('sobrenome'),
            'cpf' => $this->input('cpf'),
            'data_nascimento' => $this->input('data_nascimento'),
            'telefone' => $this->input('telefone'),
            'email' => $this->input('email'),
            'senha' => $this->input('senha'),
            'imagem' => $this->uploadImagem('imagem'),
        ];
    }
}
