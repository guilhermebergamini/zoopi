<main class="produtos-bg crud-wrap">
    <section class="container">
        <section class="actions-bar">
            <h2 class="produtos-titulo">FUNCIONARIOS</h2>
            <a class="btn btn-cadastrar" href="<?= url('/funcionarios/criar') ?>">Novo funcionario</a>
        </section>
        <section class="table-card">
            <table class="table align-middle">
                <thead><tr><th>Nome</th><th>Cargo</th><th>Email</th><th>Status</th><th>Acoes</th></tr></thead>
                <tbody>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <tr>
                            <td><?= e($funcionario['fun_nome'] . ' ' . $funcionario['fun_sobrenome']) ?></td>
                            <td><?= e($funcionario['fun_cargo']) ?></td>
                            <td><?= e($funcionario['fun_email']) ?></td>
                            <td><?= e($funcionario['fun_status']) ?></td>
                            <td>
                                <form method="post" action="<?= url('/funcionarios/excluir') ?>">
                                    <input type="hidden" name="id" value="<?= e($funcionario['fun_codigo']) ?>">
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
