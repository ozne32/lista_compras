-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 03/09/2024 às 22:39
-- Versão do servidor: 11.4.2-MariaDB-ubu2404
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `compras`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_listas`
--

CREATE TABLE `tb_listas` (
  `nome_lista` varchar(100) NOT NULL,
  `id_prods` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `visualizar` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `produto_id` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `comprado` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user_prods`
--

CREATE TABLE `tb_user_prods` (
  `id_prods` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Índices para tabelas despejadas
--
--
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario_id`, `email`, `nome`, `senha`) VALUES
(1, 'masterUser@gmail.com', 'master', 'masterUserSenha');
--
-- Índices de tabela `tb_listas`
--
ALTER TABLE `tb_listas`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `id_prods` (`id_prods`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_user1` (`id_user1`),
  ADD KEY `id_user2` (`id_user2`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices de tabela `tb_user_prods`
--
ALTER TABLE `tb_user_prods`
  ADD KEY `id_prods` (`id_prods`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_listas`
--
ALTER TABLE `tb_listas`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_listas`
--
ALTER TABLE `tb_listas`
  ADD CONSTRAINT `tb_listas_ibfk_1` FOREIGN KEY (`id_prods`) REFERENCES `tb_produtos` (`produto_id`),
  ADD CONSTRAINT `tb_listas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_usuarios` (`usuario_id`);

--
-- Restrições para tabelas `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD CONSTRAINT `tb_pedidos_ibfk_1` FOREIGN KEY (`id_user1`) REFERENCES `tb_usuarios` (`usuario_id`),
  ADD CONSTRAINT `tb_pedidos_ibfk_2` FOREIGN KEY (`id_user2`) REFERENCES `tb_usuarios` (`usuario_id`);

--
-- Restrições para tabelas `tb_user_prods`
--
ALTER TABLE `tb_user_prods`
  ADD CONSTRAINT `tb_user_prods_ibfk_1` FOREIGN KEY (`id_prods`) REFERENCES `tb_produtos` (`produto_id`),
  ADD CONSTRAINT `tb_user_prods_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
