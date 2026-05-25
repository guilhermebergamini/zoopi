<main class="login-bg">
    <section class="container d-flex justify-content-center align-items-center">
        <section class="login-card">
            <h2 class="login-title">Login</h2>
            <form method="post" action="<?= url('/login') ?>">
                <section class="mb-3">
                    <input type="email" name="email" class="form-control login-input" placeholder="Email" required>
                </section>
                <section class="mb-3">
                    <input type="password" name="senha" class="form-control login-input" placeholder="Senha" required>
                </section>
                <button type="submit" class="btn btn-enter w-100">ENTRAR</button>
                <section class="d-flex justify-content-between mt-2 login-links">
                    <a href="<?= url('/redefinir-senha') ?>">Esqueci minha senha</a>
                    <a href="<?= url('/cadastro') ?>">Cadastrar</a>
                </section>
            </form>
        </section>
    </section>
</main>
