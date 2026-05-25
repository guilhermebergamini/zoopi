<main class="produtos-bg crud-wrap">
    <section class="container">
        <section class="actions-bar">
            <h2 class="produtos-titulo">CUPONS</h2>
            <a class="btn btn-cadastrar" href="<?= url('/cupons/criar') ?>">Novo cupom</a>
        </section>
        <section class="table-card">
            <table class="table align-middle">
                <thead><tr><th>Codigo</th><th>Tipo</th><th>Valor</th><th>Validade</th><th>Status</th><th>Acoes</th></tr></thead>
                <tbody>
                    <?php foreach ($cupons as $cupom): ?>
                        <tr>
                            <td><?= e($cupom['cup_codigo_texto']) ?></td>
                            <td><?= e($cupom['cup_tipo']) ?></td>
                            <td><?= number_format($cupom['cup_valor'], 2, ',', '.') ?></td>
                            <td><?= e($cupom['cup_validade']) ?></td>
                            <td><?= e($cupom['cup_status']) ?></td>
                            <td>
                                <form method="post" action="<?= url('/cupons/excluir') ?>">
                                    <input type="hidden" name="id" value="<?= e($cupom['cup_codigo']) ?>">
                                    <button class="btn btn-sm btn-outline-danger">Inativar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </section>
</main>
