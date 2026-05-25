<main>
    <section class="banner">
        <section class="container">
            <section id="carouselExampleIndicators" class="carousel slide">
                <section class="carousel-inner">
                    <section class="carousel-item active">
                        <img src="<?= asset('assets/images/banner1zoopi.png') ?>" class="d-block w-100" alt="Banner Zoopi">
                    </section>
                </section>
            </section>
            <section class="promo-banner">
                <img src="<?= asset('assets/images/1-53355213.png') ?>" alt="Promocao">
            </section>
        </section>
    </section>

    <section class="produtos">
        <section class="container">
            <h2 class="titulo-secao">DESCOBERTAS DO DIA</h2>
            <section class="produtos-grid">
                <?php foreach ($produtos as $produto): ?>
                    <article class="produto-card" onclick="window.location='<?= url('/produtos/ver?id=' . $produto['prod_codigo']) ?>'">
                        <section class="card-img-wrap">
                            <img src="<?= imagem($produto['prod_imagem'], 'assets/images/produto1.png') ?>" alt="<?= e($produto['prod_nome']) ?>">
                        </section>
                        <section class="card-body-custom">
                            <p class="card-nome"><?= e($produto['prod_nome']) ?></p>
                            <p class="card-fabricante"><strong>Fabricante:</strong> <?= e($produto['prod_fabricante']) ?></p>
                            <section class="card-footer-info">
                                <span class="card-preco">R$ <?= number_format($produto['prod_valor'], 2, ',', '.') ?></span>
                                <span class="card-estoque"><?= e($produto['prod_quantidade']) ?> disponiveis</span>
                            </section>
                        </section>
                    </article>
                <?php endforeach; ?>
            </section>
        </section>
    </section>
</main>
