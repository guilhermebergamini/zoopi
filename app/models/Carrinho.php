<?php

require_once __DIR__ . '/../core/Model.php';

class Carrinho extends Model
{
    public function itens(int $clienteId): array
    {
        $sql = 'SELECT c.*, p.prod_nome, p.prod_imagem
            FROM carrinho c
            JOIN produtos p ON p.prod_codigo = c.prod_codigo
            WHERE c.cli_codigo = ? AND c.car_status = "ativo"
            ORDER BY c.car_codigo DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$clienteId]);
        return $stmt->fetchAll();
    }

    public function total(int $clienteId): float
    {
        $stmt = $this->db->prepare('SELECT SUM(car_quantidade * car_preco_unitario) total FROM carrinho WHERE cli_codigo = ? AND car_status = "ativo"');
        $stmt->execute([$clienteId]);
        return (float) ($stmt->fetch()['total'] ?? 0);
    }

    public function adicionar(int $clienteId, array $produto, int $quantidade): bool
    {
        $stmt = $this->db->prepare('SELECT car_codigo, car_quantidade FROM carrinho WHERE cli_codigo = ? AND prod_codigo = ? AND car_status = "ativo"');
        $stmt->execute([$clienteId, $produto['prod_codigo']]);
        $item = $stmt->fetch();

        if ($item) {
            $stmt = $this->db->prepare('UPDATE carrinho SET car_quantidade = car_quantidade + ? WHERE car_codigo = ?');
            return $stmt->execute([$quantidade, $item['car_codigo']]);
        }

        $stmt = $this->db->prepare('INSERT INTO carrinho (cli_codigo, prod_codigo, car_quantidade, car_preco_unitario) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$clienteId, $produto['prod_codigo'], $quantidade, $produto['prod_valor']]);
    }

    public function remover(int $id, int $clienteId): bool
    {
        $stmt = $this->db->prepare('UPDATE carrinho SET car_status = "removido" WHERE car_codigo = ? AND cli_codigo = ?');
        return $stmt->execute([$id, $clienteId]);
    }

    public function finalizar(int $clienteId): bool
    {
        $stmt = $this->db->prepare('UPDATE carrinho SET car_status = "finalizado" WHERE cli_codigo = ? AND car_status = "ativo"');
        return $stmt->execute([$clienteId]);
    }
}
