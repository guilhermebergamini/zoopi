<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Checkout</h2>
        <p>Total do carrinho: <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></p>
        <form method="post" action="<?= url('/pedidos/finalizar') ?>">
            <input type="text" name="cupom" placeholder="Cupom de desconto" class="form-input">
            <select name="metodo_pagamento" class="form-select">
                <option value="pix">Pix</option>
                <option value="boleto">Boleto</option>
                <option value="cartao_credito">Cartao de credito</option>
                <option value="cartao_debito">Cartao de debito</option>
            </select>
            <button class="btn btn-cadastrar">FINALIZAR PEDIDO</button>
        </form>
    </section>
</main>
