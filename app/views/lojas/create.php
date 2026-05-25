<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Cadastrar Loja</h2>
        <form method="post" action="<?= url('/lojas/salvar') ?>" enctype="multipart/form-data">
            <input type="text" name="razao_social" placeholder="Razao Social" class="form-input" required>
            <input type="text" name="nome_fantasia" placeholder="Nome Fantasia" class="form-input" required>
            <input type="text" name="cnpj" placeholder="CNPJ" class="form-input" required>
            <input type="text" name="inscricao_estadual" placeholder="Inscricao Estadual" class="form-input">
            <input type="text" name="endereco" placeholder="Endereco Completo" class="form-input">
            <input type="tel" name="telefone" placeholder="Telefone Comercial" class="form-input">
            <input type="email" name="email" placeholder="E-mail Corporativo" class="form-input" required>
            <input type="file" name="imagem" class="form-input" accept="image/*">
            <button class="btn btn-cadastrar" type="submit">CADASTRAR</button>
        </form>
    </section>
</main>
