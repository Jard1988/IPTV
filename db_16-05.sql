-- --------------------------------------------------------
-- Anfitrião:                    localhost
-- Versão do servidor:           10.4.6-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.3.0.6589
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
DROP DATABASE IF EXISTS `iptvplanner`;
CREATE DATABASE IF NOT EXISTS `iptvplanner` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `iptvplanner`;

-- A despejar estrutura para tabela iptvplanner.linhas
DROP TABLE IF EXISTS `linhas`;
CREATE TABLE IF NOT EXISTS `linhas` (
  `nome_linha` varchar(255) DEFAULT NULL,
  `linhas_id` int(50) NOT NULL AUTO_INCREMENT,
  `pago` int(11) NOT NULL DEFAULT 0,
  `caminho` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`linhas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.linhas: ~1 rows (aproximadamente)
INSERT INTO `linhas` (`nome_linha`, `linhas_id`, `pago`, `caminho`) VALUES
	('Teste', 1, 1, NULL);

-- A despejar estrutura para tabela iptvplanner.notification
DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(10) NOT NULL AUTO_INCREMENT,
  `texto` varchar(999) NOT NULL,
  `vista` int(11) NOT NULL DEFAULT 0,
  `tipo_notification` varchar(50) NOT NULL,
  `data_notification` date DEFAULT NULL,
  `users_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.notification: ~2 rows (aproximadamente)
INSERT INTO `notification` (`notification_id`, `texto`, `vista`, `tipo_notification`, `data_notification`, `users_id`) VALUES
	(1, 'teste', 0, '', '2023-05-13', 0),
	(2, 'teste2', 0, '', NULL, 0);

-- A despejar estrutura para tabela iptvplanner.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissions_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissions_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.permissions: ~3 rows (aproximadamente)
INSERT INTO `permissions` (`permissions_id`, `nome`) VALUES
	(1, 'user'),
	(2, 'moderator'),
	(3, 'admin');

-- A despejar estrutura para tabela iptvplanner.users
DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`users_id`, `email`, `password`, `permission_id`, `valid`, `nome`, `apelido`, `data_nascimento`, `telefone`, `avatar_path`) VALUES
	(1, 'teixeira.nuno88@gmail.com', '1234', 3, 1, 'Nuno', 'Teixeira', '1988-08-27', '+351917737010', 'images/123.jpg'),
	(2, 'nuno_jard@hotmail.com', 'a2l$Bg8Oi)', 1, 1, '', '', '0000-00-00', '', 'images/nuno_jard@hotmail.com.png');

-- A despejar estrutura para tabela iptvplanner.users_linhas
DROP TABLE IF EXISTS `users_linhas`;
CREATE TABLE IF NOT EXISTS `users_linhas` (
  `users_id` int(50) NOT NULL,
  `linhas_id` int(50) NOT NULL,
  `data_ini` date NOT NULL DEFAULT curdate(),
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`users_id`,`linhas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.users_linhas: ~2 rows (aproximadamente)
INSERT INTO `users_linhas` (`users_id`, `linhas_id`, `data_ini`, `data_fim`) VALUES
	(1, 2, '2023-03-24', '2023-03-26'),
	(2, 2, '2023-05-11', '2023-05-16');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
