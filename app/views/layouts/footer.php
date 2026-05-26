<?php if (in_array(($titulo ?? ''), ['Login', 'Redefinir senha'], true)): ?>
<footer class="login-footer">
    <section class="login-footer-grid">
        <section>
            <h2 class="login-footer-title">ATENDIMENTO AO CLIENTE</h2>
            <ul>
                <li><a href="#">Central de Ajuda</a></li>
                <li><a href="#">Como Comprar</a></li>
                <li><a href="#">Metodos de Pagamento</a></li>
                <li><a href="#">Garantia Xhopii</a></li>
                <li><a href="#">Devolucao e Reembolso</a></li>
                <li><a href="#">Fale Conosco</a></li>
                <li><a href="#">Ouvidoria</a></li>
            </ul>
        </section>
        <section>
            <h2 class="login-footer-title">SOBRE A XHOPII</h2>
            <ul>
                <li><a href="#">Sobre Nos</a></li>
                <li><a href="#">Politicas Xhopii</a></li>
                <li><a href="#">Politica de Privacidade</a></li>
                <li><a href="#">Programa de Afiliados da Xhopii</a></li>
                <li><a href="#">Seja um Entregador Xhopii</a></li>
                <li><a href="#">Ofertas Relampago</a></li>
                <li><a href="#">Xhopii Blog</a></li>
                <li><a href="#">Imprensa</a></li>
            </ul>
        </section>
        <section>
            <h2 class="login-footer-title">PAGAMENTO</h2>
            <section class="login-payment">
                <img src="<?= asset('assets/images/pix.png') ?>" alt="Pix">
                <img src="<?= asset('assets/images/boleto.png') ?>" alt="Boleto">
                <img src="<?= asset('assets/images/amex.png') ?>" alt="American Express">
                <img src="<?= asset('assets/images/visa.png') ?>" alt="Visa">
                <img src="<?= asset('assets/images/mc.png') ?>" alt="Mastercard">
                <img src="<?= asset('assets/images/hiper.png') ?>" alt="Hipercard">
                <img src="<?= asset('assets/images/elo-logo.svg') ?>" alt="Elo">
            </section>
        </section>
        <section>
            <h2 class="login-footer-title">SIGA-NOS</h2>
            <ul class="login-social-list">
                <li><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                <li><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                <li><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                <li><a href="#"><i class="fa fa-youtube"></i>YouTube</a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i>LinkedIn</a></li>
            </ul>
        </section>
        <section>
            <h2 class="login-footer-title">ATENDIMENTO AO CLIENTE</h2>
            <img class="login-qr" src="<?= asset('assets/images/qr code.png') ?>" alt="QR Code">
            <img class="login-store" src="<?= asset('assets/images/google-play-badge.svg') ?>" alt="Google Play">
            <img class="login-store" src="<?= asset('assets/images/app-store-badge.svg') ?>" alt="App Store">
        </section>
    </section>

    <section class="login-footer-bottom">
        <p>&copy; 2023 Xhopii. Todos os direitos acad&ecirc;micos reservados</p>
    </section>
</footer>
<?php else: ?>
<footer class="site-footer">
    <section class="container">
        <section class="row footer-links">
            <section class="col-md-3">
                <h6 class="footer-title">ATENDIMENTO AO CLIENTE</h6>
                <ul>
                    <li><a href="#">Central de Ajuda</a></li>
                    <li><a href="#">Como Comprar</a></li>
                    <li><a href="#">Metodos de Pagamento</a></li>
                    <li><a href="#">Fale Conosco</a></li>
                </ul>
            </section>
            <section class="col-md-3">
                <h6 class="footer-title">SOBRE A ZOOPI</h6>
                <ul>
                    <li><a href="#">Sobre Nos</a></li>
                    <li><a href="#">Politica de Privacidade</a></li>
                    <li><a href="#">Programa de Afiliados</a></li>
                </ul>
            </section>
            <section class="col-md-3">
                <h6 class="footer-title">PAGAMENTO</h6>
                <section class="payment-icons" style="display:flex; gap:5px; flex-wrap:wrap;">
                    <img src="<?= asset('assets/images/pix.png') ?>" alt="Pix" class="payment-badge" style="height:32px; background:#fff;">
                    <img src="<?= asset('assets/images/boleto.png') ?>" alt="Boleto" class="payment-badge" style="height:32px; background:#fff;">
                    <img src="<?= asset('assets/images/visa.png') ?>" alt="Visa" class="payment-badge" style="height:32px; background:#fff;">
                    <img src="<?= asset('assets/images/mc.png') ?>" alt="Mastercard" class="payment-badge" style="height:32px; background:#fff;">
                </section>
            </section>
            <section class="col-md-3">
                <h6 class="footer-title">SIGA-NOS</h6>
                <ul class="social-list">
                    <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i> YouTube</a></li>
                </ul>
            </section>
        </section>
    </section>
    <section class="footer-bottom">
        <p>© 2026 Zoopi. Projeto academico.</p>
    </section>
</footer>
<?php endif; ?>
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
