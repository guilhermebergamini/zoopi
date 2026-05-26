<main class="login-bg">
    <section class="login-card">
        <h1 class="login-title">Login</h1>

        <form class="login-form" method="post" action="<?= url('/login') ?>">
            <input type="email" name="email" class="login-input" placeholder="Email" autocomplete="email" required>
            <input type="password" name="senha" class="login-input" placeholder="Senha" autocomplete="current-password" required>
            <button type="submit" class="login-submit">ENTRE</button>

            <section class="login-links">
                <a href="<?= url('/redefinir-senha') ?>">Esqueci minha senha</a>
                <a href="#">Fazer login com SMS</a>
            </section>

            <section class="divider">
                <span>OU</span>
            </section>

            <section class="social-buttons">
                <button type="button" class="btn-social"><i class="fa fa-facebook-official"></i>Facebook</button>
                <button type="button" class="btn-social"><img class="social-icon" src="<?= asset('assets/images/google-g.svg') ?>" alt="">Google</button>
                <button type="button" class="btn-social"><i class="fa fa-apple"></i>Apple</button>
            </section>

            <p class="register-text">Novo na Xhopii? <a href="<?= url('/cadastro') ?>">Cadastrar</a></p>
        </form>
    </section>
</main>
