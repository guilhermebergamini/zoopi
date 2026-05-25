<?php

class Controller
{
    public function model(string $model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function view(string $view, array $dados = []): void
    {
        extract($dados);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    protected function flash(string $tipo, string $mensagem): void
    {
        $_SESSION['flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
    }

    protected function input(string $campo, $padrao = null)
    {
        return trim($_POST[$campo] ?? $padrao ?? '');
    }

    protected function uploadImagem(string $campo, string $pasta = 'uploads'): ?string
    {
        if (empty($_FILES[$campo]['name']) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $permitidos = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];
        $mime = mime_content_type($_FILES[$campo]['tmp_name']);

        if (!isset($permitidos[$mime])) {
            return null;
        }

        $destino = dirname(__DIR__, 2) . '/public/' . $pasta;
        if (!is_dir($destino)) {
            mkdir($destino, 0775, true);
        }

        $nome = uniqid('img_', true) . '.' . $permitidos[$mime];
        move_uploaded_file($_FILES[$campo]['tmp_name'], $destino . '/' . $nome);

        return BASE_URL . '/' . $pasta . '/' . $nome;
    }
}
