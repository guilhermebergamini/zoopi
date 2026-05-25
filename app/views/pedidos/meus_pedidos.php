<main class="produtos-bg crud-wrap">
    <section class="container">
        <h2 class="produtos-titulo">MEUS PEDIDOS</h2>
        <section class="table-card">
            <table class="table align-middle">
                <thead><tr><th>Pedido</th><th>Status</th><th>Subtotal</th><th>Desconto</th><th>Total</th><th>Data</th></tr></thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td>#<?= e($pedido['ped_codigo']) ?></td>
                            <td><?= e($pedido['ped_status']) ?></td>
                            <td>R$ <?= number_format($pedido['ped_subtotal'], 2, ',', '.') ?></td>
                            <td>R$ <?= number_format($pedido['ped_desconto'], 2, ',', '.') ?></td>
                            <td>R$ <?= number_format($pedido['ped_total'], 2, ',', '.') ?></td>
                            <td><?= e($pedido['ped_data']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </section>
</main>
