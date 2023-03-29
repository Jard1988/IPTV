-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para iptvplanner
CREATE DATABASE IF NOT EXISTS `iptvplanner` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `iptvplanner`;

-- A despejar estrutura para tabela iptvplanner.linhas
CREATE TABLE IF NOT EXISTS `linhas` (
  `nome_linha` varchar(255) DEFAULT NULL,
  `linhas_id` int(50) NOT NULL AUTO_INCREMENT,
  `pago` int(11) NOT NULL DEFAULT 0,
  `caminho` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`linhas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela iptvplanner.linhas: ~34 rows (aproximadamente)
REPLACE INTO `linhas` (`nome_linha`, `linhas_id`, `pago`, `caminho`) VALUES
	('AllList', 2, 1, NULL),
	('asfasfasf', 8, 0, NULL),
	('asfasfasf', 9, 0, NULL),
	('iATPOLjldM', 10, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/iATPOLjldM.m3u'),
	('d9jY6FRnEX', 11, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/d9jY6FRnEX.m3u'),
	('jCqSJUBM0k', 12, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/jCqSJUBM0k.m3u'),
	('W6ZUr1Llhq', 13, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/W6ZUr1Llhq.m3u'),
	('yUi9OVhuQq', 14, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/yUi9OVhuQq.m3u'),
	('c2shUrDRnf', 15, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/c2shUrDRnf.m3u'),
	('HIABh1q4Sn', 16, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/HIABh1q4Sn.m3u'),
	('NUd6p3ajWO', 17, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/NUd6p3ajWO.m3u'),
	('G62jHpLM09', 18, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/G62jHpLM09.m3u'),
	('8k0iwXhZeW', 19, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/8k0iwXhZeW.m3u'),
	('nANyCRvSW0', 20, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/nANyCRvSW0.m3u'),
	('BDlFESqxyT', 21, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/BDlFESqxyT.m3u'),
	('5VGdFbsODX', 22, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/5VGdFbsODX.m3u'),
	('LBNRubZ5OM', 23, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/LBNRubZ5OM.m3u'),
	('7VASmLg89X', 24, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/7VASmLg89X.m3u'),
	('8p91F4BH6c', 25, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/8p91F4BH6c.m3u'),
	('e9PNmt4hwT', 26, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/e9PNmt4hwT.m3u'),
	('q71AvZ8kH9', 27, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/q71AvZ8kH9.m3u'),
	('VQUhij83ns', 28, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/VQUhij83ns.m3u'),
	('bnpiYlM4fk', 29, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/bnpiYlM4fk.m3u'),
	('4ZjfoH7eLg', 30, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/4ZjfoH7eLg.m3u'),
	('BmP1AhTd37', 31, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/BmP1AhTd37.m3u'),
	('DecOmFMYz6', 32, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/DecOmFMYz6.m3u'),
	('3qYIrZeuMa', 33, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/3qYIrZeuMa.m3u'),
	('htknTdZsCl', 34, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/htknTdZsCl.m3u'),
	('LzYXEvRQCa', 35, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/LzYXEvRQCa.m3u'),
	('hNPcZ52Yfj', 36, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/hNPcZ52Yfj.m3u'),
	('2NQKMRw4Od', 37, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/2NQKMRw4Od.m3u'),
	('vkmQqUDhPM', 38, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/vkmQqUDhPM.m3u'),
	('aEkxnoweVL', 39, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/aEkxnoweVL.m3u'),
	('kD5fzyAtTj', 40, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/kD5fzyAtTj.m3u'),
	('kQU4O0PwHp', 41, 0, 'https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/kQU4O0PwHp.m3u');

-- A despejar estrutura para tabela iptvplanner.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissions_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissions_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela iptvplanner.permissions: ~3 rows (aproximadamente)
REPLACE INTO `permissions` (`permissions_id`, `nome`) VALUES
	(1, 'user'),
	(2, 'retail'),
	(3, 'admin');

-- A despejar estrutura para tabela iptvplanner.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permission_id` int(10) NOT NULL DEFAULT 1,
  `valid` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela iptvplanner.users: ~7 rows (aproximadamente)
REPLACE INTO `users` (`users_id`, `email`, `password`, `permission_id`, `valid`, `nome`, `apelido`, `data_nascimento`, `telefone`, `avatar_path`) VALUES
	(1, 'teixeira.nuno88@gmail.com', '1234', 3, 1, NULL, NULL, NULL, NULL, 'images/nunoas.png'),
	(5, 'nuno_jard@hotmail.com', 'G?J?gZ(_$0', 1, 1, '', '', '0000-00-00', '', NULL),
	(6, '', 'wzHXvS0(G#', 1, 0, '', '', '0000-00-00', '', NULL),
	(7, '', 'bkRK+F_B1z', 1, 0, '', '', '0000-00-00', '', NULL),
	(8, '', 'Ue9RMl?SB$', 1, 0, '', '', '0000-00-00', '', NULL),
	(9, 'nunoasf', 'fIDS5j3K#v', 1, 0, 'nunoas', '', '0000-00-00', '', '../../images/nunoas.png'),
	(10, 'sdgsdasgasfasf', 'OE@?bYoc)y', 1, 0, 'nunosdgag', '', '0000-00-00', '', '../../images/nunosdgag.png'),
	(11, 'sdgsdasgasfasf', 'GE8)sLtMrP', 1, 0, 'nunosdgag', '', '0000-00-00', '', '../../images/nunosdgag.png');

-- A despejar estrutura para tabela iptvplanner.users_linhas
CREATE TABLE IF NOT EXISTS `users_linhas` (
  `users_id` int(50) NOT NULL,
  `linhas_id` int(50) NOT NULL,
  `data_ini` date NOT NULL DEFAULT curdate(),
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`users_id`,`linhas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- A despejar dados para tabela iptvplanner.users_linhas: ~21 rows (aproximadamente)
REPLACE INTO `users_linhas` (`users_id`, `linhas_id`, `data_ini`, `data_fim`) VALUES
	(1, 0, '2023-03-27', NULL),
	(1, 2, '2023-03-24', '2023-03-26'),
	(1, 8, '2023-03-27', NULL),
	(1, 9, '2023-03-27', NULL),
	(1, 24, '2023-03-27', '2023-03-27'),
	(1, 25, '2023-03-27', '2023-03-27'),
	(1, 41, '2023-03-28', '0000-00-00'),
	(2, 0, '0000-00-00', '0000-00-00'),
	(5, 0, '0000-00-00', '0000-00-00'),
	(5, 1, '2023-03-27', NULL),
	(5, 23, '2023-03-27', '2023-03-27'),
	(5, 29, '2023-03-28', '2023-03-27'),
	(5, 30, '2023-03-28', '0000-00-00'),
	(5, 31, '2023-03-28', '0000-00-00'),
	(5, 32, '2023-03-28', '0000-00-00'),
	(5, 33, '2023-03-28', '0000-00-00'),
	(5, 34, '2023-03-28', '0000-00-00'),
	(5, 35, '2023-03-28', '0000-00-00'),
	(5, 36, '2023-03-28', '0000-00-00'),
	(5, 37, '2023-03-28', '0000-00-00'),
	(5, 38, '2023-03-28', '0000-00-00'),
	(5, 40, '2023-03-28', '0000-00-00'),
	(6, 39, '2023-03-28', '0000-00-00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
