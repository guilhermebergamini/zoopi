<?php

class PedidoController extends Controller
{
    public function checkout(): void
    {
        $clienteId = $this->clienteLogado();
        $carrinho = $this->model('Carrinho');

        $this->view('pedidos/checkout', [
            'titulo' => 'Checkout',
            'itens' => $carrinho->itens($clienteId),
            'total' => $carrinho->total($clienteId),
        ]);
    }

    public function finalizar(): void
    {
        $clienteId = $this->clienteLogado();
        $carrinho = $this->model('Carrinho');
        $itens = $carrinho->itens($clienteId);
        $subtotal = $carrinho->total($clienteId);

        if (!$itens) {
            $this->flash('danger', 'Seu carrinho esta vazio.');
            $this->redirect('/carrinho');
        }

        $desconto = 0;
        $cupomId = null;
        $cupomCodigo = $this->input('cupom');

        if ($cupomCodigo !== '') {
            $cupom = $this->model('Cupom')->buscarPorCodigo($cupomCodigo);
            if ($cupom && $subtotal >= (float) $cupom['cup_valor_minimo']) {
                $cupomId = (int) $cupom['cup_codigo'];
                $desconto = $cupom['cup_tipo'] === 'porcentagem'
                    ? $subtotal * ((float) $cupom['cup_valor'] / 100)
                    : (float) $cupom['cup_valor'];
            }
        }

        $pedidoId = $this->model('Pedido')->criar($clienteId, $itens, $subtotal, $desconto, $cupomId);
        $this->model('Pagamento')->criar($pedidoId, $this->input('metodo_pagamento', 'pix'), max(0, $subtotal - $desconto));
        $carrinho->finalizar($clienteId);

        $this->flash('success', 'Pedido finalizado com sucesso.');
        $this->redirect('/meus-pedidos');
    }

    public function meusPedidos(): void
    {
        $clienteId = $this->clienteLogado();
        $this->view('pedidos/meus_pedidos', [
            'titulo' => 'Meus Pedidos',
            'pedidos' => $this->model('Pedido')->doCliente($clienteId),
        ]);
    }

    private function clienteLogado(): int
    {
        if (empty($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
            $this->flash('danger', 'Faca login como cliente para finalizar compras.');
            $this->redirect('/login');
        }

        return (int) $_SESSION['usuario']['id'];
    }
}
