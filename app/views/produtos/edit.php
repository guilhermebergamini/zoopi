<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Editar Produto</h2>
        <?php if (!$produto): ?>
            <p>Produto nao encontrado.</p>
        <?php else: ?>
            <form method="post" action="<?= url('/produtos/atualizar') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= e($produto['prod_codigo']) ?>">
                <?php require __DIR__ . '/form.php'; ?>
                <button class="btn btn-cadastrar" type="submit">SALVAR</button>
            </form>
        <?php endif; ?>
    </section>
</main>
