-- Banco de dados adaptado para o projeto Zoopi
-- Baseado no modelo enviado rentgo (13).sql, ajustado para e-commerce simples
-- Compatível com MySQL/MariaDB/phpMyAdmin

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `zoopi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zoopi`;

-- Remove tabelas na ordem correta para evitar erro de chave estrangeira
DROP TABLE IF EXISTS `itens_pedido`;
DROP TABLE IF EXISTS `pagamentos`;
DROP TABLE IF EXISTS `pedidos`;
DROP TABLE IF EXISTS `carrinho`;
DROP TABLE IF EXISTS `avaliacoes_produto`;
DROP TABLE IF EXISTS `produto_imagens`;
DROP TABLE IF EXISTS `produtos`;
DROP TABLE IF EXISTS `cupons`;
DROP TABLE IF EXISTS `funcionarios`;
DROP TABLE IF EXISTS `lojas`;
DROP TABLE IF EXISTS `cliente_enderecos`;
DROP TABLE IF EXISTS `tokens_recuperacao`;
DROP TABLE IF EXISTS `clientes`;
DROP TABLE IF EXISTS `categorias`;

-- Categorias usadas para organizar os produtos exibidos no site
CREATE TABLE `categorias` (
  `cat_codigo` INT NOT NULL AUTO_INCREMENT,
  `cat_nome` VARCHAR(60) NOT NULL,
  `cat_descricao` VARCHAR(255) DEFAULT NULL,
  `cat_status` ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`cat_codigo`),
  UNIQUE KEY `uk_categoria_nome` (`cat_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Clientes cadastrados pela tela cadastro_cliente.html e usados no login/compra
CREATE TABLE `clientes` (
  `cli_codigo` INT NOT NULL AUTO_INCREMENT,
  `cli_nome` VARCHAR(60) NOT NULL,
  `cli_sobrenome` VARCHAR(60) DEFAULT NULL,
  `cli_cpf` VARCHAR(14) NOT NULL,
  `cli_data_nascimento` DATE DEFAULT NULL,
  `cli_telefone` VARCHAR(20) DEFAULT NULL,
  `cli_email` VARCHAR(100) NOT NULL,
  `cli_senha` VARCHAR(255) NOT NULL,
  `cli_imagem` VARCHAR(255) DEFAULT NULL,
  `cli_status` ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `cli_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cli_atualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cli_codigo`),
  UNIQUE KEY `uk_cliente_email` (`cli_email`),
  UNIQUE KEY `uk_cliente_cpf` (`cli_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Endereços dos clientes, separados para permitir mais de um endereço por cliente
CREATE TABLE `cliente_enderecos` (
  `end_codigo` INT NOT NULL AUTO_INCREMENT,
  `cli_codigo` INT NOT NULL,
  `end_nome` VARCHAR(100) NOT NULL DEFAULT 'Principal',
  `end_cep` VARCHAR(9) DEFAULT NULL,
  `end_rua` VARCHAR(255) NOT NULL,
  `end_numero` VARCHAR(20) DEFAULT NULL,
  `end_complemento` VARCHAR(100) DEFAULT NULL,
  `end_bairro` VARCHAR(100) DEFAULT NULL,
  `end_cidade` VARCHAR(100) DEFAULT NULL,
  `end_estado` CHAR(2) DEFAULT NULL,
  `end_principal` TINYINT(1) NOT NULL DEFAULT 0,
  `end_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`end_codigo`),
  KEY `idx_cliente_enderecos_cliente` (`cli_codigo`),
  CONSTRAINT `fk_cliente_enderecos_cliente` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Lojas/vendedores do marketplace Zoopi
CREATE TABLE `lojas` (
  `loj_codigo` INT NOT NULL AUTO_INCREMENT,
  `loj_razao_social` VARCHAR(120) NOT NULL,
  `loj_nome_fantasia` VARCHAR(120) NOT NULL,
  `loj_cnpj` VARCHAR(18) NOT NULL,
  `loj_inscricao_estadual` VARCHAR(30) DEFAULT NULL,
  `loj_endereco` VARCHAR(255) DEFAULT NULL,
  `loj_telefone` VARCHAR(20) DEFAULT NULL,
  `loj_email` VARCHAR(100) NOT NULL,
  `loj_imagem` VARCHAR(255) DEFAULT NULL,
  `loj_status` ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `loj_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`loj_codigo`),
  UNIQUE KEY `uk_loja_cnpj` (`loj_cnpj`),
  UNIQUE KEY `uk_loja_email` (`loj_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Funcionários cadastrados pelo painel administrativo do projeto
CREATE TABLE `funcionarios` (
  `fun_codigo` INT NOT NULL AUTO_INCREMENT,
  `fun_nome` VARCHAR(60) NOT NULL,
  `fun_sobrenome` VARCHAR(60) DEFAULT NULL,
  `fun_cpf` VARCHAR(14) NOT NULL,
  `fun_data_nascimento` DATE DEFAULT NULL,
  `fun_telefone` VARCHAR(20) DEFAULT NULL,
  `fun_cargo` VARCHAR(80) NOT NULL,
  `fun_salario` DECIMAL(10,2) DEFAULT NULL,
  `fun_email` VARCHAR(100) NOT NULL,
  `fun_senha` VARCHAR(255) NOT NULL,
  `fun_imagem` VARCHAR(255) DEFAULT NULL,
  `fun_status` ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `fun_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fun_codigo`),
  UNIQUE KEY `uk_funcionario_cpf` (`fun_cpf`),
  UNIQUE KEY `uk_funcionario_email` (`fun_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Produtos da loja; corresponde às telas cadastro_produto, ver_produtos e produto
CREATE TABLE `produtos` (
  `prod_codigo` INT NOT NULL AUTO_INCREMENT,
  `cat_codigo` INT DEFAULT NULL,
  `loj_codigo` INT DEFAULT NULL,
  `prod_nome` VARCHAR(120) NOT NULL,
  `prod_fabricante` VARCHAR(100) DEFAULT NULL,
  `prod_descricao` TEXT DEFAULT NULL,
  `prod_valor` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `prod_quantidade` INT NOT NULL DEFAULT 0,
  `prod_imagem` VARCHAR(255) DEFAULT NULL,
  `prod_status` ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `prod_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_atualizado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prod_codigo`),
  KEY `idx_produtos_categoria` (`cat_codigo`),
  KEY `idx_produtos_loja` (`loj_codigo`),
  CONSTRAINT `fk_produtos_categoria` FOREIGN KEY (`cat_codigo`) REFERENCES `categorias` (`cat_codigo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_produtos_loja` FOREIGN KEY (`loj_codigo`) REFERENCES `lojas` (`loj_codigo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Imagens extras para a galeria da página produto.html
CREATE TABLE `produto_imagens` (
  `img_codigo` INT NOT NULL AUTO_INCREMENT,
  `prod_codigo` INT NOT NULL,
  `img_caminho` VARCHAR(255) NOT NULL,
  `img_alt` VARCHAR(150) DEFAULT NULL,
  `img_ordem` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`img_codigo`),
  KEY `idx_produto_imagens_produto` (`prod_codigo`),
  CONSTRAINT `fk_produto_imagens_produto` FOREIGN KEY (`prod_codigo`) REFERENCES `produtos` (`prod_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Cupons cadastrados pela tela cadastro_cupons.html
CREATE TABLE `cupons` (
  `cup_codigo` INT NOT NULL AUTO_INCREMENT,
  `cup_codigo_texto` VARCHAR(30) NOT NULL,
  `cup_descricao` VARCHAR(255) DEFAULT NULL,
  `cup_tipo` ENUM('porcentagem','valor_fixo') NOT NULL,
  `cup_valor` DECIMAL(10,2) NOT NULL,
  `cup_valor_minimo` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `cup_quantidade` INT NOT NULL DEFAULT 0,
  `cup_validade` DATE NOT NULL,
  `cup_status` ENUM('ativo','inativo','expirado') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`cup_codigo`),
  UNIQUE KEY `uk_cupom_codigo_texto` (`cup_codigo_texto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Carrinho ativo do cliente
CREATE TABLE `carrinho` (
  `car_codigo` INT NOT NULL AUTO_INCREMENT,
  `cli_codigo` INT NOT NULL,
  `prod_codigo` INT NOT NULL,
  `car_quantidade` INT NOT NULL DEFAULT 1,
  `car_preco_unitario` DECIMAL(10,2) NOT NULL,
  `car_data_adicao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `car_status` ENUM('ativo','finalizado','removido') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`car_codigo`),
  KEY `idx_carrinho_cliente` (`cli_codigo`),
  KEY `idx_carrinho_produto` (`prod_codigo`),
  CONSTRAINT `fk_carrinho_cliente` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_carrinho_produto` FOREIGN KEY (`prod_codigo`) REFERENCES `produtos` (`prod_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pedidos finalizados pelo cliente
CREATE TABLE `pedidos` (
  `ped_codigo` INT NOT NULL AUTO_INCREMENT,
  `cli_codigo` INT NOT NULL,
  `cup_codigo` INT DEFAULT NULL,
  `ped_status` ENUM('pendente','pago','enviado','entregue','cancelado') NOT NULL DEFAULT 'pendente',
  `ped_subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `ped_desconto` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `ped_frete` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `ped_total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `ped_data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ped_codigo`),
  KEY `idx_pedidos_cliente` (`cli_codigo`),
  KEY `idx_pedidos_cupom` (`cup_codigo`),
  CONSTRAINT `fk_pedidos_cliente` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_pedidos_cupom` FOREIGN KEY (`cup_codigo`) REFERENCES `cupons` (`cup_codigo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Produtos dentro de cada pedido
CREATE TABLE `itens_pedido` (
  `item_codigo` INT NOT NULL AUTO_INCREMENT,
  `ped_codigo` INT NOT NULL,
  `prod_codigo` INT NOT NULL,
  `item_quantidade` INT NOT NULL,
  `item_preco_unitario` DECIMAL(10,2) NOT NULL,
  `item_total` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`item_codigo`),
  KEY `idx_itens_pedido_pedido` (`ped_codigo`),
  KEY `idx_itens_pedido_produto` (`prod_codigo`),
  CONSTRAINT `fk_itens_pedido_pedido` FOREIGN KEY (`ped_codigo`) REFERENCES `pedidos` (`ped_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_itens_pedido_produto` FOREIGN KEY (`prod_codigo`) REFERENCES `produtos` (`prod_codigo`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pagamentos vinculados ao pedido
CREATE TABLE `pagamentos` (
  `pag_codigo` INT NOT NULL AUTO_INCREMENT,
  `ped_codigo` INT NOT NULL,
  `pag_metodo` ENUM('pix','boleto','cartao_credito','cartao_debito') NOT NULL,
  `pag_status` ENUM('pendente','aprovado','recusado','estornado') NOT NULL DEFAULT 'pendente',
  `pag_valor` DECIMAL(10,2) NOT NULL,
  `pag_data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pag_transacao` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`pag_codigo`),
  KEY `idx_pagamentos_pedido` (`ped_codigo`),
  CONSTRAINT `fk_pagamentos_pedido` FOREIGN KEY (`ped_codigo`) REFERENCES `pedidos` (`ped_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Avaliações de produtos pelos clientes
CREATE TABLE `avaliacoes_produto` (
  `ava_codigo` INT NOT NULL AUTO_INCREMENT,
  `prod_codigo` INT NOT NULL,
  `cli_codigo` INT NOT NULL,
  `ava_nota` DECIMAL(2,1) NOT NULL,
  `ava_comentario` TEXT DEFAULT NULL,
  `ava_data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ava_codigo`),
  KEY `idx_avaliacoes_produto` (`prod_codigo`),
  KEY `idx_avaliacoes_cliente` (`cli_codigo`),
  CONSTRAINT `fk_avaliacoes_produto` FOREIGN KEY (`prod_codigo`) REFERENCES `produtos` (`prod_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_avaliacoes_cliente` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chk_avaliacao_nota` CHECK (`ava_nota` >= 0 AND `ava_nota` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tokens para tela redefenir_senha.html
CREATE TABLE `tokens_recuperacao` (
  `tok_codigo` INT NOT NULL AUTO_INCREMENT,
  `cli_codigo` INT NOT NULL,
  `tok_token` VARCHAR(255) NOT NULL,
  `tok_expira_em` DATETIME NOT NULL,
  `tok_usado` TINYINT(1) NOT NULL DEFAULT 0,
  `tok_criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tok_codigo`),
  UNIQUE KEY `uk_token_recuperacao` (`tok_token`),
  KEY `idx_tokens_cliente` (`cli_codigo`),
  CONSTRAINT `fk_tokens_cliente` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados iniciais coerentes com as telas estáticas do projeto
INSERT INTO `categorias` (`cat_codigo`, `cat_nome`, `cat_descricao`) VALUES
(1, 'Roupas', 'Camisetas, moletons e vestuário em geral'),
(2, 'Eletrônicos', 'Produtos eletrônicos e acessórios'),
(3, 'Casa', 'Itens para casa e decoração'),
(4, 'Promoções', 'Produtos com desconto');

INSERT INTO `lojas` (`loj_codigo`, `loj_razao_social`, `loj_nome_fantasia`, `loj_cnpj`, `loj_inscricao_estadual`, `loj_endereco`, `loj_telefone`, `loj_email`, `loj_imagem`) VALUES
(1, 'Dallas Uniformes LTDA', 'Dallas Uniformes', '00.000.000/0001-00', 'ISENTO', 'Rua Exemplo, 100', '(18) 99999-9999', 'contato@dallasuniformes.com', '../assets/images/logo.png');

INSERT INTO `clientes` (`cli_codigo`, `cli_nome`, `cli_sobrenome`, `cli_cpf`, `cli_data_nascimento`, `cli_telefone`, `cli_email`, `cli_senha`, `cli_imagem`) VALUES
(1, 'Cliente', 'Teste', '000.000.000-00', '2000-01-01', '(18) 99999-9999', 'cliente@zoopi.com', MD5('123'), '../assets/images/icone zoppi.png');

INSERT INTO `funcionarios` (`fun_codigo`, `fun_nome`, `fun_sobrenome`, `fun_cpf`, `fun_data_nascimento`, `fun_telefone`, `fun_cargo`, `fun_salario`, `fun_email`, `fun_senha`, `fun_imagem`) VALUES
(1, 'Administrador', 'Zoopi', '111.111.111-11', '1999-01-01', '(18) 98888-8888', 'Administrador', 2500.00, 'admin@zoopi.com', MD5('123'), '../assets/images/icone zoppi.png');

INSERT INTO `produtos` (`prod_codigo`, `cat_codigo`, `loj_codigo`, `prod_nome`, `prod_fabricante`, `prod_descricao`, `prod_valor`, `prod_quantidade`, `prod_imagem`) VALUES
(1, 1, 1, 'Camisa Desenvolvedor Front-End CSS', 'Dallas Uniformes', 'Camiseta temática para desenvolvedores Front-End.', 56.90, 171, '../assets/images/produto1.png'),
(2, 1, 1, 'Camisa Desenvolvedor Front-End Azul', 'Dallas Uniformes', 'Modelo alternativo azul da camiseta de desenvolvedor.', 56.90, 120, '../assets/images/produto2.png'),
(3, 1, 1, 'Camisa Desenvolvedor Front-End Verde', 'Dallas Uniformes', 'Modelo alternativo verde da camiseta de desenvolvedor.', 56.90, 85, '../assets/images/produto3.png'),
(4, 1, 1, 'Camisa Desenvolvedor Front-End Cinza', 'Dallas Uniformes', 'Modelo alternativo cinza da camiseta de desenvolvedor.', 56.90, 95, '../assets/images/produto4.png'),
(5, 1, 1, 'Camisa Desenvolvedor Front-End Rosa', 'Dallas Uniformes', 'Modelo alternativo rosa da camiseta de desenvolvedor.', 56.90, 70, '../assets/images/produto5.png');

INSERT INTO `produto_imagens` (`prod_codigo`, `img_caminho`, `img_alt`, `img_ordem`) VALUES
(1, '../assets/images/produto1.png', 'Camiseta preta', 1),
(1, '../assets/images/produto2.png', 'Camiseta azul', 2),
(1, '../assets/images/produto3.png', 'Camiseta verde', 3),
(1, '../assets/images/produto4.png', 'Camiseta cinza', 4),
(1, '../assets/images/produto5.png', 'Camiseta rosa', 5);

INSERT INTO `cupons` (`cup_codigo_texto`, `cup_descricao`, `cup_tipo`, `cup_valor`, `cup_valor_minimo`, `cup_quantidade`, `cup_validade`) VALUES
('PROMO10', 'Cupom de 10% de desconto', 'porcentagem', 10.00, 50.00, 100, '2026-12-31'),
('ZOOPI20', 'R$20 de desconto em compras acima de R$100', 'valor_fixo', 20.00, 100.00, 50, '2026-12-31');

COMMIT;
