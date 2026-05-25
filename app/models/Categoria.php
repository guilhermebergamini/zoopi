<?php

require_once __DIR__ . '/../core/Model.php';

class Categoria extends Model
{
    public function todas(): array
    {
        return $this->db->query('SELECT * FROM categorias WHERE cat_status = "ativo" ORDER BY cat_nome')->fetchAll();
    }
}
