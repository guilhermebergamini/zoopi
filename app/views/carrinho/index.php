<main class="produtos-bg crud-wrap">
    <section class="container">
        <h2 class="produtos-titulo">CARRINHO</h2>
        <section class="table-card">
            <?php if (!$itens): ?>
                <p>Seu carrinho esta vazio.</p>
            <?php else: ?>
                <table class="table align-middle">
                    <thead><tr><th>Produto</th><th>Quantidade</th><th>Preco</th><th>Total</th><th></th></tr></thead>
                    <tbody>
                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td><?= e($item['prod_nome']) ?></td>
                                <td><?= e($item['car_quantidade']) ?></td>
                                <td>R$ <?= number_format($item['car_preco_unitario'], 2, ',', '.') ?></td>
                                <td>R$ <?= number_format($item['car_preco_unitario'] * $item['car_quantidade'], 2, ',', '.') ?></td>
                                <td>
                                    <form method="post" action="<?= url('/carrinho/remover') ?>">
                                        <input type="hidden" name="id" value="<?= e($item['car_codigo']) ?>">
                                        <button class="btn btn-sm btn-outline-danger">Remover</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3>Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
                <a class="btn btn-cadastrar" href="<?= url('/checkout') ?>">Finalizar compra</a>
            <?php endif; ?>
        </section>
    </section>
</main>
