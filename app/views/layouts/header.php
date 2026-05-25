<?php
if (!function_exists('e')) {
    function e($valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string
    {
        return BASE_URL . $path;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return ASSET_URL . '/' . ltrim($path, '/');
    }
}

if (!function_exists('imagem')) {
    function imagem(?string $path, string $fallback = 'assets/images/logo.png'): string
    {
        if (!$path) {
            return asset($fallback);
        }

        if (str_starts_with($path, BASE_URL) || str_starts_with($path, 'http')) {
            return $path;
        }

        return asset(str_replace('../', '', $path));
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo ?? 'Zoopi') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= asset('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/header.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/home.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/cad.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/ver_produtos.css') ?>">
    <link rel="icon" href="<?= asset('assets/images/icone zoppi.png') ?>" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .crud-wrap { padding: 32px 0; }
        .actions-bar { display: flex; gap: 10px; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; }
        .table-card { background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 16px; overflow-x: auto; }
        .form-card form { display: grid; gap: 12px; }
        .form-select { border-radius: 6px; min-height: 42px; }
        .small-actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .produto-card { cursor: pointer; }
        .empty-state { background: #fff; border: 1px solid #eee; padding: 24px; border-radius: 8px; text-align: center; }
    </style>
</head>
<body>
<header class="header">
    <section class="top-bar">
        <section class="container">
            <section class="logo">
                <img src="<?= asset('assets/images/logo.png') ?>" alt="Logo">
                <h1>Zoopi</h1>
            </section>
            <section class="top-actions">
                <?php if (!empty($_SESSION['usuario'])): ?>
                    <span><?= e($_SESSION['usuario']['nome']) ?></span>
                    <a href="<?= url('/logout') ?>">Sair</a>
                <?php else: ?>
                    <a href="<?= url('/login') ?>">Entrar</a>
                <?php endif; ?>
            </section>
        </section>
    </section>
    <nav class="menu">
        <section class="container-nav">
            <ul>
                <li><a href="<?= url('/') ?>">Home</a></li>
                <li><a href="<?= url('/clientes/criar') ?>">Cadastro Cliente</a></li>
                <li><a href="<?= url('/funcionarios/criar') ?>">Cadastro Funcionario</a></li>
                <li><a href="<?= url('/produtos/criar') ?>">Cadastro Produto</a></li>
                <li><a href="<?= url('/lojas/criar') ?>">Cadastro Loja</a></li>
                <li><a href="<?= url('/cupons/criar') ?>">Cadastro Cupom</a></li>
                <li><a href="<?= url('/clientes') ?>">Clientes</a></li>
                <li><a href="<?= url('/funcionarios') ?>">Funcionarios</a></li>
                <li><a href="<?= url('/produtos') ?>">Produtos</a></li>
                <li><a href="<?= url('/carrinho') ?>">Carrinho</a></li>
            </ul>
        </section>
    </nav>
</header>

<?php if (!empty($_SESSION['flash'])): ?>
    <section class="container mt-3">
        <section class="alert alert-<?= e($_SESSION['flash']['tipo']) ?>">
            <?= e($_SESSION['flash']['mensagem']) ?>
        </section>
    </section>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
