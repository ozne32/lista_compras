-- Banco de dados: `compras`

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user_prods`
--

DROP TABLE IF EXISTS `tb_user_prods`;

CREATE TABLE `tb_user_prods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prods` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_prod` (`id_prods`, `id_user`),
  CONSTRAINT `tb_user_prods_ibfk_1` FOREIGN KEY (`id_prods`) REFERENCES `tb_produtos` (`produto_id`),
  CONSTRAINT `tb_user_prods_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_usuarios` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

DROP TABLE IF EXISTS `tb_produtos`;

CREATE TABLE `tb_produtos` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(255) NOT NULL,
  `comprado` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;

CREATE TABLE `tb_usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
