<main class="pagina-form">
    <section class="form-card">
        <h2 class="form-titulo">Cadastrar Cupom</h2>
        <form method="post" action="<?= url('/cupons/salvar') ?>">
            <input type="text" name="codigo" placeholder="Codigo do Cupom (Ex: PROMO10)" class="form-input" required>
            <input type="text" name="descricao" placeholder="Descricao do Cupom" class="form-input">
            <select name="tipo" class="form-select" required>
                <option value="">Tipo de Desconto</option>
                <option value="porcentagem">Porcentagem (%)</option>
                <option value="valor_fixo">Valor Fixo (R$)</option>
            </select>
            <input type="number" step="0.01" name="valor" placeholder="Valor ou Porcentagem do Desconto" class="form-input" required>
            <input type="number" step="0.01" name="valor_minimo" placeholder="Valor Minimo de Compra" class="form-input">
            <input type="number" name="quantidade" placeholder="Quantidade Disponivel" class="form-input">
            <label class="form-label-foto">Data de Validade:</label>
            <input type="date" name="validade" class="form-input" required>
            <button class="btn btn-cadastrar" type="submit">CADASTRAR</button>
        </form>
    </section>
</main>
