<?php
// Arquivo criado para estrutura MVC do projeto Zoopi.
class Router
{
    private array $rotas = [];

    public function get($url, $acao)
    {
        $this->rotas['GET'][$url] = $acao;
    }

    public function post($url, $acao)
    {
        $this->rotas['POST'][$url] = $acao;
    }

    public function executar()
    {
        $url = parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH);
        $metodo = $_SERVER['REQUEST_METHOD'];

        $base = '/zoopi/public';
        $url= str_replace($base , '' , $url);

        if ($url == ''){
            $url = '/';
        }

        if (isset($this->rotas[$metodo][$url])){
            [$controller, $metodoController] = explode('@' , $this->rotas[$metodo][$url]);

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            $obj = new $controller();
            $obj->$metodoController();
        }   else {
            echo "Erro 404 - Página não encontrada";
        }
    }
}


?>