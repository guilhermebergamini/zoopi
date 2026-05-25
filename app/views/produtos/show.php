<main class="produtos-bg crud-wrap">
    <section class="container">
        <?php if (!$produto): ?>
            <section class="empty-state">Produto nao encontrado.</section>
        <?php else: ?>
            <section class="row g-4 align-items-start">
                <section class="col-md-5">
                    <img class="img-fluid bg-white p-3 rounded" src="<?= imagem($produto['prod_imagem'], 'assets/images/produto1.png') ?>" alt="<?= e($produto['prod_nome']) ?>">
                </section>
                <section class="col-md-7 table-card">
                    <h2><?= e($produto['prod_nome']) ?></h2>
                    <p><?= e($produto['prod_descricao']) ?></p>
                    <h3>R$ <?= number_format($produto['prod_valor'], 2, ',', '.') ?></h3>
                    <p><?= e($produto['prod_quantidade']) ?> unidades disponiveis</p>
                    <form method="post" action="<?= url('/carrinho/adicionar') ?>" class="d-flex gap-2">
                        <input type="hidden" name="produto_id" value="<?= e($produto['prod_codigo']) ?>">
                        <input type="number" name="quantidade" value="1" min="1" class="form-control" style="max-width:100px;">
                        <button class="btn btn-cadastrar">Adicionar ao carrinho</button>
                    </form>
                </section>
            </section>
        <?php endif; ?>
    </section>
</main>
