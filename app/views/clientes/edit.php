<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Editar Cliente</h2>
        <?php if (!$cliente): ?>
            <p>Cliente nao encontrado.</p>
        <?php else: ?>
            <form method="post" action="<?= url('/clientes/atualizar') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= e($cliente['cli_codigo']) ?>">
                <input type="text" name="nome" value="<?= e($cliente['cli_nome']) ?>" placeholder="Nome" class="form-input" required>
                <input type="text" name="sobrenome" value="<?= e($cliente['cli_sobrenome']) ?>" placeholder="Sobrenome" class="form-input">
                <input type="text" name="cpf" value="<?= e($cliente['cli_cpf']) ?>" placeholder="CPF" class="form-input" required>
                <input type="date" name="data_nascimento" value="<?= e($cliente['cli_data_nascimento']) ?>" class="form-input">
                <input type="tel" name="telefone" value="<?= e($cliente['cli_telefone']) ?>" placeholder="Telefone" class="form-input">
                <input type="email" name="email" value="<?= e($cliente['cli_email']) ?>" placeholder="Email" class="form-input" required>
                <input type="password" name="senha" placeholder="Nova senha opcional" class="form-input">
                <select name="status" class="form-select">
                    <option value="ativo" <?= $cliente['cli_status'] === 'ativo' ? 'selected' : '' ?>>Ativo</option>
                    <option value="inativo" <?= $cliente['cli_status'] === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                </select>
                <input type="file" name="imagem" class="form-input" accept="image/*">
                <button class="btn btn-cadastrar" type="submit">SALVAR</button>
            </form>
        <?php endif; ?>
    </section>
</main>
