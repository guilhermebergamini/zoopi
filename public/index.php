<?php

session_start();

define('BASE_URL', '/zoopi/public');
define('ASSET_URL', '/zoopi/src');

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';

$router = new Router();
require_once __DIR__ . '/../routes/web.php';
$router->executar();
