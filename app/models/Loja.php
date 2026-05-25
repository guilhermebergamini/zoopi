<?php

require_once __DIR__ . '/../core/Model.php';

class Loja extends Model
{
    public function todas(): array
    {
        return $this->db->query('SELECT * FROM lojas ORDER BY loj_codigo DESC')->fetchAll();
    }

    public function ativas(): array
    {
        return $this->db->query('SELECT * FROM lojas WHERE loj_status = "ativo" ORDER BY loj_nome_fantasia')->fetchAll();
    }

    public function criar(array $dados): bool
    {
        $sql = 'INSERT INTO lojas
            (loj_razao_social, loj_nome_fantasia, loj_cnpj, loj_inscricao_estadual, loj_endereco, loj_telefone, loj_email, loj_imagem)
            VALUES (:razao, :fantasia, :cnpj, :inscricao, :endereco, :telefone, :email, :imagem)';

        return $this->db->prepare($sql)->execute([
            ':razao' => $dados['razao_social'],
            ':fantasia' => $dados['nome_fantasia'],
            ':cnpj' => $dados['cnpj'],
            ':inscricao' => $dados['inscricao_estadual'] ?: null,
            ':endereco' => $dados['endereco'] ?: null,
            ':telefone' => $dados['telefone'] ?: null,
            ':email' => $dados['email'],
            ':imagem' => $dados['imagem'] ?: null,
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE lojas SET loj_status = "inativo" WHERE loj_codigo = ?');
        return $stmt->execute([$id]);
    }
}
