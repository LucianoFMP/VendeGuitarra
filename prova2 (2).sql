-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 14:20
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prova2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho_compras`
--

CREATE TABLE `carrinho_compras` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho_compras`
--

INSERT INTO `carrinho_compras` (`id`, `cliente_id`, `produto_id`, `quantidade`) VALUES
(2, 3, 2, 1),
(3, 5, 4, 1),
(4, 13, 5, 1),
(5, 14, 3, 2),
(6, 5, 4, 1),
(7, 5, 6, 2),
(8, 5, 3, 1),
(9, 15, 8, 1),
(10, 15, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `comprovante` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `foto`, `comprovante`) VALUES
(3, 'Luke Skywalker II', 'lukeskywalker@gmail.com', 'luke123', 'uploads/67437445189af_luke.jpg', 'uploads/6743744518b87_form.pdf'),
(4, 'Rodrigulio Amparo', 'rodrigulio.amparo@aluno.fmpsc.edu.br', 'rod123', 'uploads/6744802f81968_lukesabre.jpg', 'uploads/6744802f81c08_form (3).pdf'),
(5, 'Jar Jar Binks', 'jarjarules@gmail.com', 'jar123', 'uploads/6745804ed6eef_jarjar.jpg', 'uploads/6745804ed7203_form (3).pdf'),
(6, 'Luciano Neto', 'luciano.neto@aluno.fmpsc.edu.br', 'luc123', 'uploads/6745860924e2a_Edital público.jpg', 'uploads/6745860925165_form (3).pdf'),
(12, 'Darth Vader', 'darth.vader@viloesqamamos.com.br', 'dar123', 'uploads/67458c221ff78_darth.jpg', 'uploads/67458c222024b_form (3).pdf'),
(13, 'rodrigo silva', 'rodrigo.silva@aluno.fmp.sc', 'rod123', 'uploads/67465d13ec9ad_WhatsApp-Image-2024-11-26-at-13.50.46.jpeg', 'uploads/67465d13ed1a4_form (3).pdf'),
(14, 'Han Solo', 'han.solo@gmail.com', 'han123', 'uploads/674662e3e1be6_han-solo.jpeg', 'uploads/674662e3e61f7_form (3).pdf'),
(15, 'joao', 'joao@gmail.com', 'jo123', 'uploads/67471a17533dc_han-solo.jpeg', 'uploads/67471a1753970_form (4).pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`) VALUES
(1, 'Guitarra Queens', 500.00, 'uploads/67436f7897b21_guitarra1.png'),
(2, 'Gibson Flying VB-2', 18690.00, 'uploads/67436f830b5a9_guitarra2.png'),
(3, 'Guitarra Ibanez', 1000.00, 'uploads/67436f8ccf68f_guitarra3.png'),
(4, 'Fender Strato Austin', 600.00, 'uploads/67436f97bf643_guitarra4.png'),
(5, 'Golden Strato Ibanez', 3500.00, 'uploads/67436fa1d2d37_guitarra5.png'),
(6, 'Gibson Les Paul', 12000.00, 'uploads/67436fac38431_guitarra6.png'),
(7, 'Super Strato Ibanez', 2000.00, 'uploads/67436fb577e75_guitarra7.jpg'),
(8, 'Guitarra TEG-320', 800.00, 'uploads/67436fbf5ddda_guitarra8.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho_compras`
--
ALTER TABLE `carrinho_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho_compras`
--
ALTER TABLE `carrinho_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho_compras`
--
ALTER TABLE `carrinho_compras`
  ADD CONSTRAINT `carrinho_compras_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `carrinho_compras_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
