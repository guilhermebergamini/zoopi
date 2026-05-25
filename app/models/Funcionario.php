<?php

require_once __DIR__ . '/../core/Model.php';

class Funcionario extends Model
{
    public function todos(): array
    {
        return $this->db->query('SELECT * FROM funcionarios ORDER BY fun_codigo DESC')->fetchAll();
    }

    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM funcionarios WHERE fun_email = ? AND fun_status = "ativo"');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function criar(array $dados): bool
    {
        $sql = 'INSERT INTO funcionarios
            (fun_nome, fun_sobrenome, fun_cpf, fun_data_nascimento, fun_telefone, fun_cargo, fun_salario, fun_email, fun_senha, fun_imagem)
            VALUES (:nome, :sobrenome, :cpf, :nascimento, :telefone, :cargo, :salario, :email, :senha, :imagem)';

        return $this->db->prepare($sql)->execute([
            ':nome' => $dados['nome'],
            ':sobrenome' => $dados['sobrenome'] ?: null,
            ':cpf' => $dados['cpf'],
            ':nascimento' => $dados['data_nascimento'] ?: null,
            ':telefone' => $dados['telefone'] ?: null,
            ':cargo' => $dados['cargo'],
            ':salario' => $dados['salario'] ?: null,
            ':email' => $dados['email'],
            ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            ':imagem' => $dados['imagem'] ?: null,
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE funcionarios SET fun_status = "inativo" WHERE fun_codigo = ?');
        return $stmt->execute([$id]);
    }
}
