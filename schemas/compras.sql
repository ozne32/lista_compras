-- Estrutura para tabela `tb_produtos`

CREATE TABLE `tb_produtos` (
  `produto_id` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `comprado` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Índices para tabela `tb_produtos`
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`produto_id`);

-- AUTO_INCREMENT para tabela `tb_produtos`
ALTER TABLE `tb_produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT;
