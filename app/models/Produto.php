<?php

require_once __DIR__ . '/../core/Model.php';

class Produto extends Model
{
    public function todos(): array
    {
        $sql = 'SELECT p.*, c.cat_nome, l.loj_nome_fantasia
            FROM produtos p
            LEFT JOIN categorias c ON c.cat_codigo = p.cat_codigo
            LEFT JOIN lojas l ON l.loj_codigo = p.loj_codigo
            ORDER BY p.prod_codigo DESC';
        return $this->db->query($sql)->fetchAll();
    }

    public function ativos(int $limite = 0): array
    {
        $sql = 'SELECT * FROM produtos WHERE prod_status = "ativo" ORDER BY prod_codigo DESC';
        if ($limite > 0) {
            $sql .= ' LIMIT ' . $limite;
        }
        return $this->db->query($sql)->fetchAll();
    }

    public function buscar(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM produtos WHERE prod_codigo = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function criar(array $dados): bool
    {
        $sql = 'INSERT INTO produtos
            (cat_codigo, loj_codigo, prod_nome, prod_fabricante, prod_descricao, prod_valor, prod_quantidade, prod_imagem)
            VALUES (:categoria, :loja, :nome, :fabricante, :descricao, :valor, :quantidade, :imagem)';

        return $this->db->prepare($sql)->execute([
            ':categoria' => $dados['cat_codigo'] ?: null,
            ':loja' => $dados['loj_codigo'] ?: null,
            ':nome' => $dados['nome'],
            ':fabricante' => $dados['fabricante'] ?: null,
            ':descricao' => $dados['descricao'] ?: null,
            ':valor' => $dados['valor'],
            ':quantidade' => $dados['quantidade'],
            ':imagem' => $dados['imagem'] ?: null,
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        $sql = 'UPDATE produtos SET
            cat_codigo = :categoria,
            loj_codigo = :loja,
            prod_nome = :nome,
            prod_fabricante = :fabricante,
            prod_descricao = :descricao,
            prod_valor = :valor,
            prod_quantidade = :quantidade,
            prod_imagem = :imagem,
            prod_status = :status
            WHERE prod_codigo = :id';

        return $this->db->prepare($sql)->execute([
            ':id' => $id,
            ':categoria' => $dados['cat_codigo'] ?: null,
            ':loja' => $dados['loj_codigo'] ?: null,
            ':nome' => $dados['nome'],
            ':fabricante' => $dados['fabricante'] ?: null,
            ':descricao' => $dados['descricao'] ?: null,
            ':valor' => $dados['valor'],
            ':quantidade' => $dados['quantidade'],
            ':imagem' => $dados['imagem'] ?: null,
            ':status' => $dados['status'] ?? 'ativo',
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE produtos SET prod_status = "inativo" WHERE prod_codigo = ?');
        return $stmt->execute([$id]);
    }
}
