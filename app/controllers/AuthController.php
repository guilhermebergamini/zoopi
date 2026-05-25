<?php

class AuthController extends Controller
{
    public function login(): void
    {
        $this->view('auth/login', ['titulo' => 'Login']);
    }

    public function autenticar(): void
    {
        $email = $this->input('email');
        $senha = $this->input('senha');

        $clienteModel = $this->model('Cliente');
        $funcionarioModel = $this->model('Funcionario');

        $usuario = $clienteModel->buscarPorEmail($email);
        $tipo = 'cliente';

        if (!$usuario) {
            $usuario = $funcionarioModel->buscarPorEmail($email);
            $tipo = 'funcionario';
        }

        $hash = $usuario[$tipo === 'cliente' ? 'cli_senha' : 'fun_senha'] ?? '';
        $senhaOk = password_verify($senha, $hash) || md5($senha) === $hash;

        if (!$usuario || !$senhaOk) {
            $this->flash('danger', 'Email ou senha invalidos.');
            $this->redirect('/login');
        }

        $_SESSION['usuario'] = [
            'id' => $usuario[$tipo === 'cliente' ? 'cli_codigo' : 'fun_codigo'],
            'nome' => $usuario[$tipo === 'cliente' ? 'cli_nome' : 'fun_nome'],
            'tipo' => $tipo,
        ];

        $this->redirect('/');
    }

    public function logout(): void
    {
        unset($_SESSION['usuario']);
        $this->redirect('/login');
    }

    public function cadastro(): void
    {
        $this->view('auth/cadastro', ['titulo' => 'Cadastro']);
    }

    public function salvarCadastro(): void
    {
        $cliente = $this->model('Cliente');
        $cliente->criar($this->dadosCliente());
        $this->flash('success', 'Cadastro realizado. Faca login para continuar.');
        $this->redirect('/login');
    }

    public function redefinirSenha(): void
    {
        $this->view('auth/redefinir_senha', ['titulo' => 'Redefinir senha']);
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
            'imagem' => $this->uploadImagem('imagem') ?: $this->input('imagem'),
        ];
    }
}
