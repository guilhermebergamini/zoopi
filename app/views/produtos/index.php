<main class="produtos-bg">
    <section class="container">
        <section class="actions-bar">
            <h2 class="produtos-titulo">PRODUTOS</h2>
            <a class="btn btn-cadastrar" href="<?= url('/produtos/criar') ?>">Novo produto</a>
        </section>
        <section class="produtos-grid">
            <?php foreach ($produtos as $produto): ?>
                <article class="produto-card">
                    <section class="card-img-wrap">
                        <img src="<?= imagem($produto['prod_imagem'], 'assets/images/produto1.png') ?>" alt="<?= e($produto['prod_nome']) ?>">
                    </section>
                    <section class="card-body-custom">
                        <p class="card-nome"><?= e($produto['prod_nome']) ?></p>
                        <p class="card-fabricante"><strong>Fabricante:</strong> <?= e($produto['prod_fabricante']) ?></p>
                        <p class="card-descricao"><strong>Descricao:</strong> <?= e($produto['prod_descricao']) ?></p>
                        <section class="card-footer-info">
                            <span class="card-preco">R$ <?= number_format($produto['prod_valor'], 2, ',', '.') ?></span>
                            <span class="card-estoque"><?= e($produto['prod_quantidade']) ?> disponiveis</span>
                        </section>
                        <section class="small-actions mt-2">
                            <a class="btn btn-sm btn-outline-primary" href="<?= url('/produtos/ver?id=' . $produto['prod_codigo']) ?>">Ver</a>
                            <a class="btn btn-sm btn-outline-secondary" href="<?= url('/produtos/editar?id=' . $produto['prod_codigo']) ?>">Editar</a>
                            <form method="post" action="<?= url('/produtos/excluir') ?>">
                                <input type="hidden" name="id" value="<?= e($produto['prod_codigo']) ?>">
                                <button class="btn btn-sm btn-outline-danger">Inativar</button>
                            </form>
                        </section>
                    </section>
                </article>
            <?php endforeach; ?>
        </section>
    </section>
</main>
