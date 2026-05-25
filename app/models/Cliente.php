<?php

require_once __DIR__ . '/../core/Model.php';

class Cliente extends Model
{
    public function todos(): array
    {
        return $this->db->query('SELECT * FROM clientes ORDER BY cli_codigo DESC')->fetchAll();
    }

    public function buscar(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM clientes WHERE cli_codigo = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM clientes WHERE cli_email = ? AND cli_status = "ativo"');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function criar(array $dados): bool
    {
        $sql = 'INSERT INTO clientes
            (cli_nome, cli_sobrenome, cli_cpf, cli_data_nascimento, cli_telefone, cli_email, cli_senha, cli_imagem)
            VALUES (:nome, :sobrenome, :cpf, :nascimento, :telefone, :email, :senha, :imagem)';

        return $this->db->prepare($sql)->execute([
            ':nome' => $dados['nome'],
            ':sobrenome' => $dados['sobrenome'] ?: null,
            ':cpf' => $dados['cpf'],
            ':nascimento' => $dados['data_nascimento'] ?: null,
            ':telefone' => $dados['telefone'] ?: null,
            ':email' => $dados['email'],
            ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            ':imagem' => $dados['imagem'] ?: null,
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        $camposSenha = '';
        $params = [
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':sobrenome' => $dados['sobrenome'] ?: null,
            ':cpf' => $dados['cpf'],
            ':nascimento' => $dados['data_nascimento'] ?: null,
            ':telefone' => $dados['telefone'] ?: null,
            ':email' => $dados['email'],
            ':imagem' => $dados['imagem'] ?: null,
            ':status' => $dados['status'] ?? 'ativo',
        ];

        if (!empty($dados['senha'])) {
            $camposSenha = ', cli_senha = :senha';
            $params[':senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }

        $sql = "UPDATE clientes SET
            cli_nome = :nome,
            cli_sobrenome = :sobrenome,
            cli_cpf = :cpf,
            cli_data_nascimento = :nascimento,
            cli_telefone = :telefone,
            cli_email = :email,
            cli_imagem = :imagem,
            cli_status = :status
            {$camposSenha}
            WHERE cli_codigo = :id";

        return $this->db->prepare($sql)->execute($params);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE clientes SET cli_status = "inativo" WHERE cli_codigo = ?');
        return $stmt->execute([$id]);
    }
}
