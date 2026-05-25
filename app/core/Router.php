<?php

class Router
{
    private array $rotas = [];

    public function get(string $url, string $acao): void
    {
        $this->rotas['GET'][$url] = $acao;
    }

    public function post(string $url, string $acao): void
    {
        $this->rotas['POST'][$url] = $acao;
    }

    public function executar(): void
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $metodo = $_SERVER['REQUEST_METHOD'];
        $url = str_replace(BASE_URL, '', $url);

        if ($url === '') {
            $url = '/';
        }

        if (!isset($this->rotas[$metodo][$url])) {
            http_response_code(404);
            echo 'Erro 404 - Pagina nao encontrada';
            return;
        }

        [$controller, $metodoController] = explode('@', $this->rotas[$metodo][$url]);
        require_once __DIR__ . '/../controllers/' . $controller . '.php';

        $obj = new $controller();
        $obj->$metodoController();
    }
}
