<main class="produtos-bg crud-wrap">
    <section class="container">
        <section class="actions-bar">
            <h2 class="produtos-titulo">CLIENTES</h2>
            <a class="btn btn-cadastrar" href="<?= url('/clientes/criar') ?>">Novo cliente</a>
        </section>
        <section class="table-card">
            <table class="table align-middle">
                <thead><tr><th>Nome</th><th>CPF</th><th>Email</th><th>Status</th><th>Acoes</th></tr></thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= e($cliente['cli_nome'] . ' ' . $cliente['cli_sobrenome']) ?></td>
                            <td><?= e($cliente['cli_cpf']) ?></td>
                            <td><?= e($cliente['cli_email']) ?></td>
                            <td><?= e($cliente['cli_status']) ?></td>
                            <td class="small-actions">
                                <a class="btn btn-sm btn-outline-primary" href="<?= url('/clientes/editar?id=' . $cliente['cli_codigo']) ?>">Editar</a>
                                <form method="post" action="<?= url('/clientes/excluir') ?>">
                                    <input type="hidden" name="id" value="<?= e($cliente['cli_codigo']) ?>">
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
