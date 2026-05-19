<?php
// Arquivo criado para estrutura MVC do projeto Zoopi.

class Database 
{
    private string $host = "localhost";
    private string $dbname = "zoopi";
    private string $user = "root";
    private string $password = "";

    public function conectar()
    {
        try{
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8" , $this->user, $this->password
            );

            $pdo->setAttribute(PDO:ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e){
            die("Erro ao conectar com o banco: " . $e->getMessage());
        }
    }
}
?>