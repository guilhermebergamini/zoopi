<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Cadastrar Cliente</h2>
        <form method="post" action="<?= url('/clientes/salvar') ?>" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome" class="form-input" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" class="form-input">
            <input type="text" name="cpf" placeholder="CPF" class="form-input" required>
            <input type="date" name="data_nascimento" class="form-input">
            <input type="tel" name="telefone" placeholder="Telefone" class="form-input">
            <input type="email" name="email" placeholder="Email" class="form-input" required>
            <input type="password" name="senha" placeholder="Senha" class="form-input" required>
            <label class="form-label-foto">Selecionar foto de perfil:</label>
            <input type="file" name="imagem" class="form-input" accept="image/*">
            <button class="btn btn-cadastrar" type="submit">CADASTRAR</button>
        </form>
    </section>
</main>
