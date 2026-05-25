<?php

require_once __DIR__ . '/../core/Model.php';

class Pagamento extends Model
{
    public function criar(int $pedidoId, string $metodo, float $valor): bool
    {
        $stmt = $this->db->prepare('INSERT INTO pagamentos (ped_codigo, pag_metodo, pag_valor, pag_status) VALUES (?, ?, ?, "aprovado")');
        return $stmt->execute([$pedidoId, $metodo, $valor]);
    }
}
