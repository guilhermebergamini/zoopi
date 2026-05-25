<select name="cat_codigo" class="form-select">
    <option value="">Categoria</option>
    <?php foreach ($categorias as $categoria): ?>
        <option value="<?= e($categoria['cat_codigo']) ?>" <?= ($produto['cat_codigo'] ?? '') == $categoria['cat_codigo'] ? 'selected' : '' ?>>
            <?= e($categoria['cat_nome']) ?>
        </option>
    <?php endforeach; ?>
</select>
<select name="loj_codigo" class="form-select">
    <option value="">Loja</option>
    <?php foreach ($lojas as $loja): ?>
        <option value="<?= e($loja['loj_codigo']) ?>" <?= ($produto['loj_codigo'] ?? '') == $loja['loj_codigo'] ? 'selected' : '' ?>>
            <?= e($loja['loj_nome_fantasia']) ?>
        </option>
    <?php endforeach; ?>
</select>
<input type="text" name="nome" value="<?= e($produto['prod_nome'] ?? '') ?>" placeholder="Nome" class="form-input" required>
<input type="text" name="fabricante" value="<?= e($produto['prod_fabricante'] ?? '') ?>" placeholder="Fabricante" class="form-input">
<textarea name="descricao" placeholder="Descricao" class="form-input"><?= e($produto['prod_descricao'] ?? '') ?></textarea>
<input type="number" step="0.01" name="valor" value="<?= e($produto['prod_valor'] ?? '') ?>" placeholder="Valor" class="form-input" required>
<input type="number" name="quantidade" value="<?= e($produto['prod_quantidade'] ?? '') ?>" placeholder="Quantidade" class="form-input" required>
<select name="status" class="form-select">
    <option value="ativo" <?= ($produto['prod_status'] ?? 'ativo') === 'ativo' ? 'selected' : '' ?>>Ativo</option>
    <option value="inativo" <?= ($produto['prod_status'] ?? '') === 'inativo' ? 'selected' : '' ?>>Inativo</option>
</select>
<label class="form-label-foto">Selecionar foto do produto:</label>
<input type="file" name="imagem" class="form-input" accept="image/*">
