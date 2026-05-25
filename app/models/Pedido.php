<?php

require_once __DIR__ . '/../core/Model.php';

class Pedido extends Model
{
    public function criar(int $clienteId, array $itens, float $subtotal, float $desconto = 0, ?int $cupomId = null): int
    {
        $total = max(0, $subtotal - $desconto);
        $this->db->beginTransaction();

        $stmt = $this->db->prepare('INSERT INTO pedidos (cli_codigo, cup_codigo, ped_subtotal, ped_desconto, ped_total) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$clienteId, $cupomId, $subtotal, $desconto, $total]);
        $pedidoId = (int) $this->db->lastInsertId();

        $itemSql = 'INSERT INTO itens_pedido (ped_codigo, prod_codigo, item_quantidade, item_preco_unitario, item_total) VALUES (?, ?, ?, ?, ?)';
        $itemStmt = $this->db->prepare($itemSql);

        foreach ($itens as $item) {
            $itemTotal = $item['car_quantidade'] * $item['car_preco_unitario'];
            $itemStmt->execute([$pedidoId, $item['prod_codigo'], $item['car_quantidade'], $item['car_preco_unitario'], $itemTotal]);
        }

        $this->db->commit();
        return $pedidoId;
    }

    public function doCliente(int $clienteId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM pedidos WHERE cli_codigo = ? ORDER BY ped_codigo DESC');
        $stmt->execute([$clienteId]);
        return $stmt->fetchAll();
    }
}
