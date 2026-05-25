<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $produtoModel = $this->model('Produto');
        $this->view('home/index', [
            'titulo' => 'Zoopi',
            'produtos' => $produtoModel->ativos(8),
        ]);
    }
}
