-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Jun-2023 às 20:54
-- Versão do servidor: 10.6.12-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u615300448_iptvplanner`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhas`
--

CREATE TABLE `linhas` (
  `nome_linha` varchar(255) DEFAULT NULL,
  `linhas_id` int(50) NOT NULL,
  `pago` int(11) NOT NULL DEFAULT 0,
  `caminho` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `linhas`
--

INSERT INTO `linhas` (`nome_linha`, `linhas_id`, `pago`, `caminho`) VALUES
('Teste', 1, 1, NULL),
('dbN35HIJRE', 11, 0, 'http://iptvplanner.pt/dbN35HIJRE.m3u');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) NOT NULL,
  `texto` varchar(999) NOT NULL,
  `vista` int(11) NOT NULL DEFAULT 0,
  `tipo_notification` varchar(50) NOT NULL,
  `data_notification` date DEFAULT NULL,
  `users_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `notification`
--

INSERT INTO `notification` (`notification_id`, `texto`, `vista`, `tipo_notification`, `data_notification`, `users_id`) VALUES
(1, 'teste', 0, '', '2023-05-13', 0),
(2, 'teste2', 0, '', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `permissions_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`permissions_id`, `nome`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permission_id` int(10) NOT NULL DEFAULT 1,
  `valid` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`users_id`, `email`, `password`, `permission_id`, `valid`, `nome`, `apelido`, `data_nascimento`, `telefone`, `avatar_path`) VALUES
(1, 'teixeira.nuno88@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, 1, 'Nuno', 'Teixeira', '1988-08-27', '+351917737010', 'images/123.jpg'),
(12, 'Ricardo_tt_77@outlook.pt', 'w9ChSPzWNj', 1, 1, 'Ricardo', 'Cafe Encontro', '0000-00-00', '', 'images/Ricardo_tt_77@outlook.pt.png'),
(16, 'pereiraarmando977@gmail.com', '2ba7bebd3bcc3ae20a00a9e948b4a5fc650ca5b5', 1, 1, 'Armando', 'Pereira', '0000-00-00', '934754867', 'images/pereiraarmando977@gmail.com.png'),
(18, 'fborges_daniela@hotmail.com', 'V6euJ(SI_T', 1, 1, 'Daniela ', 'Borges', '0000-00-00', '', 'images/fborges_daniela@hotmail.com.png'),
(19, 'nuno_jard@hotmail.com', 'SW9IHN)GC=', 1, 1, '', '', '0000-00-00', '', 'images/nuno_jard@hotmail.com.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_linhas`
--

CREATE TABLE `users_linhas` (
  `users_id` int(50) NOT NULL,
  `linhas_id` int(50) NOT NULL,
  `data_ini` date NOT NULL DEFAULT curdate(),
  `data_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `users_linhas`
--

INSERT INTO `users_linhas` (`users_id`, `linhas_id`, `data_ini`, `data_fim`) VALUES
(1, 1, '2023-03-24', '2023-03-26'),
(19, 11, '2023-06-02', '0000-00-00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `linhas`
--
ALTER TABLE `linhas`
  ADD PRIMARY KEY (`linhas_id`);

--
-- Índices para tabela `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Índices para tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissions_id`) USING BTREE;

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Índices para tabela `users_linhas`
--
ALTER TABLE `users_linhas`
  ADD PRIMARY KEY (`users_id`,`linhas_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `linhas`
--
ALTER TABLE `linhas`
  MODIFY `linhas_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
