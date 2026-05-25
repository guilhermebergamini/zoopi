<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Cadastrar Funcionario</h2>
        <form method="post" action="<?= url('/funcionarios/salvar') ?>" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome" class="form-input" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" class="form-input">
            <input type="text" name="cpf" placeholder="CPF" class="form-input" required>
            <input type="date" name="data_nascimento" class="form-input">
            <input type="tel" name="telefone" placeholder="Telefone" class="form-input">
            <input type="text" name="cargo" placeholder="Cargo / Funcao" class="form-input" required>
            <input type="number" step="0.01" name="salario" placeholder="Salario" class="form-input">
            <input type="email" name="email" placeholder="Email" class="form-input" required>
            <input type="password" name="senha" placeholder="Senha" class="form-input" required>
            <input type="file" name="imagem" class="form-input" accept="image/*">
            <button class="btn btn-cadastrar" type="submit">CADASTRAR</button>
        </form>
    </section>
</main>
