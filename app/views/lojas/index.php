<main class="produtos-bg crud-wrap">
    <section class="container">
        <section class="actions-bar">
            <h2 class="produtos-titulo">LOJAS</h2>
            <a class="btn btn-cadastrar" href="<?= url('/lojas/criar') ?>">Nova loja</a>
        </section>
        <section class="table-card">
            <table class="table align-middle">
                <thead><tr><th>Fantasia</th><th>CNPJ</th><th>Email</th><th>Status</th><th>Acoes</th></tr></thead>
                <tbody>
                    <?php foreach ($lojas as $loja): ?>
                        <tr>
                            <td><?= e($loja['loj_nome_fantasia']) ?></td>
                            <td><?= e($loja['loj_cnpj']) ?></td>
                            <td><?= e($loja['loj_email']) ?></td>
                            <td><?= e($loja['loj_status']) ?></td>
                            <td>
                                <form method="post" action="<?= url('/lojas/excluir') ?>">
                                    <input type="hidden" name="id" value="<?= e($loja['loj_codigo']) ?>">
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
