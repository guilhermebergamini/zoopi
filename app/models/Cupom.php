<?php

require_once __DIR__ . '/../core/Model.php';

class Cupom extends Model
{
    public function todos(): array
    {
        return $this->db->query('SELECT * FROM cupons ORDER BY cup_codigo DESC')->fetchAll();
    }

    public function buscarPorCodigo(string $codigo): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM cupons WHERE cup_codigo_texto = ? AND cup_status = "ativo"');
        $stmt->execute([$codigo]);
        return $stmt->fetch() ?: null;
    }

    public function criar(array $dados): bool
    {
        $sql = 'INSERT INTO cupons
            (cup_codigo_texto, cup_descricao, cup_tipo, cup_valor, cup_valor_minimo, cup_quantidade, cup_validade)
            VALUES (:codigo, :descricao, :tipo, :valor, :minimo, :quantidade, :validade)';

        return $this->db->prepare($sql)->execute([
            ':codigo' => strtoupper($dados['codigo']),
            ':descricao' => $dados['descricao'] ?: null,
            ':tipo' => $dados['tipo'],
            ':valor' => $dados['valor'],
            ':minimo' => $dados['valor_minimo'] ?: 0,
            ':quantidade' => $dados['quantidade'] ?: 0,
            ':validade' => $dados['validade'],
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE cupons SET cup_status = "inativo" WHERE cup_codigo = ?');
        return $stmt->execute([$id]);
    }
}
