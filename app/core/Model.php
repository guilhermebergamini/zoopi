<?php
// Arquivo criado para estrutura MVC do projeto Zoopi.

require_once __DIR__ . '/../config/Database.php';

class Model
{
    protected $db;

    public function __contrusct()
    {
        $database = new Database();
        $this->db = $database->conectar();
    }
}
?>