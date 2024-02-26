-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25/02/2024 às 23:53
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `salon-beauty`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agendamento` int(11) NOT NULL,
  `criador_agendamento` varchar(256) NOT NULL,
  `id_criador_agendamento` int(11) NOT NULL,
  `observacao_agendamento` varchar(256) NOT NULL,
  `dataCad` date NOT NULL,
  `tipo_serv` enum('Cabelos','Hidratacao','Unhas') NOT NULL,
  `situacao_agendamento` varchar(50) NOT NULL DEFAULT 'Em Processamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id_agendamento`, `criador_agendamento`, `id_criador_agendamento`, `observacao_agendamento`, `dataCad`, `tipo_serv`, `situacao_agendamento`) VALUES
(15, 'Cliente', 31, 'Quero pintar o cabelo de loiro! Ja estou levando a tinta.', '2024-02-27', 'Cabelos', 'Em Processamento'),
(16, 'Cliente', 31, 'Espero que vocês tenham uma cor vermelha cintilante!!', '2024-02-22', 'Unhas', 'Em Processamento'),
(17, 'Cliente', 31, 'Não tenho o creme pra levar! Meu cabelo é cachado e não me dou bem com oleo de Ricino.', '2024-03-01', 'Hidratacao', 'Negado'),
(18, 'Luis Claudio', 30, 'Quero cor preta! Avisando pois muitas vezes nao tem de tão requisitada hahaha :D', '2024-02-28', 'Unhas', 'Aceito'),
(19, 'Luis Claudio', 30, 'Gosto muito de Oleo de manteiga!', '2024-02-24', 'Hidratacao', 'Concluído'),
(20, 'Luis Claudio', 30, 'Quero pintar o cabelo de preto!', '2024-02-24', 'Cabelos', 'Concluído');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `permission_id` int(1) DEFAULT 0,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `nome`, `email`, `senha`, `permission_id`, `birthdate`) VALUES
(23, 'Leila Cabeleleila', 'leilacabelosunhas@email.com', '21232f297a57a5a743894a0e4a801fc3', 2, NULL),
(30, 'Luis Claudio', 'sobrinhoneto@email.com', 'e80e51dec5534cee5dd36946997e1788', 1, NULL),
(31, 'Cliente', 'cliente@email.com', '202cb962ac59075b964b07152d234b70', 0, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agendamento`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
