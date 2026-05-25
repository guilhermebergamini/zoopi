<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Cadastrar Produto</h2>
        <form method="post" action="<?= url('/produtos/salvar') ?>" enctype="multipart/form-data">
            <?php require __DIR__ . '/form.php'; ?>
            <button class="btn btn-cadastrar" type="submit">CADASTRAR</button>
        </form>
    </section>
</main>
