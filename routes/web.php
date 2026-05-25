<?php

$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index');

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@autenticar');
$router->get('/logout', 'AuthController@logout');
$router->get('/cadastro', 'AuthController@cadastro');
$router->post('/cadastro', 'AuthController@salvarCadastro');
$router->get('/redefinir-senha', 'AuthController@redefinirSenha');

$router->get('/produtos', 'ProdutoController@index');
$router->get('/produtos/criar', 'ProdutoController@create');
$router->post('/produtos/salvar', 'ProdutoController@store');
$router->get('/produtos/ver', 'ProdutoController@show');
$router->get('/produtos/editar', 'ProdutoController@edit');
$router->post('/produtos/atualizar', 'ProdutoController@update');
$router->post('/produtos/excluir', 'ProdutoController@delete');

$router->get('/clientes', 'ClienteController@index');
$router->get('/clientes/criar', 'ClienteController@create');
$router->post('/clientes/salvar', 'ClienteController@store');
$router->get('/clientes/editar', 'ClienteController@edit');
$router->post('/clientes/atualizar', 'ClienteController@update');
$router->post('/clientes/excluir', 'ClienteController@delete');

$router->get('/funcionarios', 'FuncionarioController@index');
$router->get('/funcionarios/criar', 'FuncionarioController@create');
$router->post('/funcionarios/salvar', 'FuncionarioController@store');
$router->post('/funcionarios/excluir', 'FuncionarioController@delete');

$router->get('/lojas', 'LojaController@index');
$router->get('/lojas/criar', 'LojaController@create');
$router->post('/lojas/salvar', 'LojaController@store');
$router->post('/lojas/excluir', 'LojaController@delete');

$router->get('/cupons', 'CupomController@index');
$router->get('/cupons/criar', 'CupomController@create');
$router->post('/cupons/salvar', 'CupomController@store');
$router->post('/cupons/excluir', 'CupomController@delete');

$router->get('/carrinho', 'CarrinhoController@index');
$router->post('/carrinho/adicionar', 'CarrinhoController@adicionar');
$router->post('/carrinho/remover', 'CarrinhoController@remover');

$router->get('/checkout', 'PedidoController@checkout');
$router->post('/pedidos/finalizar', 'PedidoController@finalizar');
$router->get('/meus-pedidos', 'PedidoController@meusPedidos');
