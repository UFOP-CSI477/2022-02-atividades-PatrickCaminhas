-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Mar-2023 às 05:27
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanchonete`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ingredientes` varchar(200) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cardapio`
--

INSERT INTO `cardapio` (`id`, `nome`, `ingredientes`, `tipo`, `preco`) VALUES
(1, 'Hamburguer', 'Pão, bife, queijo, presunto, batata palha, milho', 'Simples', 8),
(2, 'X-Bacon', 'Pão, bife, bacon, queijo, presunto, batata palha, milho verde', 'Simples', 10),
(3, 'X-Tudo', 'Pão, bife, bacon, ovo, alface, tomate, batata palha, milho verde', 'Simples', 14),
(4, 'Turbinado', 'Pão, 2 bifes, bacon, ovo, cheddar, alface, tomate, batata palha, milho verde.', 'Simples', 18),
(5, 'Poderoso', 'Pão de brioche, blend 90gr, bacon, cebola caramelizada.', 'Artesanal', 15),
(6, 'Gandalf', 'Pão de brioche, 2 blends 90gr, Cheddar, Bacon, Molho especial', 'Artesanal', 16),
(7, 'PlayBurguer', 'Pão selado na manteiga, Blend de 130gr, batata palha, pickles', 'Artesanal', 15),
(8, 'MorteSubita', 'Pão selado na manteiga, 2 blend de 130gr, bacon, pickles, cheddar, frango desfiado', 'Artesanal', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `administrador` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `cpf`, `nome`, `senha`, `administrador`) VALUES
(1, '12345678910', 'Patrick', '202cb962ac59075b964b07152d234b70', 'sim'),
(2, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'sim'),
(3, '1234', 'patrickc', 'admin', 'nao'),
(6, '12345', 'tiao', '123', ''),
(7, '123456710', 'tiao', '123', ''),
(8, '10394902', 'josefino', '123', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedidoId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lanches` varchar(300) NOT NULL,
  `criacao_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `ultima_atualizacao` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pedidoId`, `user_id`, `lanches`, `criacao_pedido`, `ultima_atualizacao`, `status`, `preco`) VALUES
(79, 5, 'Hamburguer: 1 | X-Bacon: 2 | Turbinado: 1 | ', '2023-03-15 03:21:03', '2023-03-15 23:44:39', 'Aceito', 46),
(80, 5, 'Hamburguer: 1 | X-Bacon: 2 | Turbinado: 1 | ', '2023-03-15 03:34:11', '2023-03-15 23:44:39', 'Em preparo', 46),
(81, 5, 'Hamburguer: 1 | X-Bacon: 1 | X-Tudo: 1 | ', '2023-03-15 03:34:17', '2023-03-15 03:34:17', 'Concluido', 32),
(82, 12, 'Hamburguer: 1 | X-Bacon: 1 | Poderoso: 1 | ', '2023-03-15 10:22:51', '2023-03-15 23:44:39', 'Enviado', 33),
(84, 5, 'Hamburguer: 1 | X-Tudo: 1 | Gandalf: 1 | PlayBurguer: 1 | ', '2023-03-15 21:14:07', '2023-03-15 21:14:07', 'Concluido', 53),
(85, 5, 'Hamburguer: 1 | X-Tudo: 2 | Poderoso: 3 | PlayBurguer: 4 | ', '2023-03-15 21:14:11', '2023-03-15 21:14:11', 'Concluido', 141);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `estaAberto` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`estaAberto`) VALUES
('fechada'),
('fechada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `rua` varchar(70) NOT NULL,
  `numero` int(6) NOT NULL,
  `complemento` varchar(70) NOT NULL,
  `bairro` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `rua`, `numero`, `complemento`, `bairro`) VALUES
(5, 'Patrick Caminhas', 'patrick1@gmail', '202cb962ac59075b964b07152d234b70', 'aaaa', 4, 'zzzz', 'wwww'),
(7, '', '', '', '', 0, '', ''),
(8, 'patrick', 'patrick231', '3141234', '43413245', 543456234, '625654', '562546'),
(9, 'PATRICK C MATOS', 'patrickcaminhasm@gmail.com', '1213234', 'Rua Santos Dumont', 476, '124141', '3414'),
(10, 'afasfa', 'fasfaf', 'sfasfas', 'safasfa', 0, 'asfasf', 'fasfasf'),
(12, 'Patrick Caminhas', 'patrickcaminhasm@gmail', '123', '1', 11, '1', '1'),
(13, 'aaa', 'aaa@aaa', '1234', 'a', 0, 'a', 'a');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidoId`),
  ADD KEY `FK_USUARIO` (`user_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
