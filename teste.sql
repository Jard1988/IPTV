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


-- A despejar estrutura da base de dados para airsoftplanner
CREATE DATABASE IF NOT EXISTS `airsoftplanner` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `airsoftplanner`;

-- A despejar estrutura para tabela airsoftplanner.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `evento_id` int(10) NOT NULL AUTO_INCREMENT,
  `organizador_id` int(10) NOT NULL,
  `data_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  PRIMARY KEY (`evento_id`),
  KEY `data_evento` (`data_evento`),
  KEY `organizador_id` (`organizador_id`),
  KEY `hora_evento` (`hora_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.evento: ~2 rows (aproximadamente)
INSERT INTO `evento` (`evento_id`, `organizador_id`, `data_evento`, `hora_evento`) VALUES
	(1, 1, '2023-10-10', '09:15:00'),
	(2, 1, '0000-00-00', '00:00:00'),
	(3, 2, '0000-00-00', '00:00:00');

-- A despejar estrutura para tabela airsoftplanner.evento/user
CREATE TABLE IF NOT EXISTS `evento/user` (
  `evento_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `fracao_id` int(10) NOT NULL,
  `pago` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`evento_id`),
  KEY `users_id` (`users_id`),
  KEY `fracao_id` (`fracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.evento/user: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela airsoftplanner.fracao
CREATE TABLE IF NOT EXISTS `fracao` (
  `fracao_id` int(10) NOT NULL AUTO_INCREMENT,
  `nome_fracao` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`fracao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.fracao: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela airsoftplanner.organizador
CREATE TABLE IF NOT EXISTS `organizador` (
  `organizador_id` int(10) NOT NULL AUTO_INCREMENT,
  `nome_organizador` varchar(255) NOT NULL DEFAULT '',
  `morada_evento` varchar(50) NOT NULL,
  `coordenada_1` varchar(50) NOT NULL,
  `coordenada_2` varchar(50) NOT NULL,
  `descricao_evento` varchar(50) NOT NULL,
  PRIMARY KEY (`organizador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.organizador: ~2 rows (aproximadamente)
INSERT INTO `organizador` (`organizador_id`, `nome_organizador`, `morada_evento`, `coordenada_1`, `coordenada_2`, `descricao_evento`) VALUES
	(1, 'Organizador 1', 'avecar', '', '', 'afwfasfafzvgzdvvbnuno'),
	(2, 'Organizador 2', 'campo_x', '', '', 'dfhfdhsfbdgbdsb');

-- A despejar estrutura para tabela airsoftplanner.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissions_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissions_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.permissions: ~3 rows (aproximadamente)
INSERT INTO `permissions` (`permissions_id`, `nome`) VALUES
	(1, 'user'),
	(2, 'team'),
	(3, 'admin');

-- A despejar estrutura para tabela airsoftplanner.team
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.team: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela airsoftplanner.team_users
CREATE TABLE IF NOT EXISTS `team_users` (
  `team_user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `team_id` int(10) NOT NULL,
  PRIMARY KEY (`team_user_id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.team_users: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela airsoftplanner.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permission_id` int(10) NOT NULL DEFAULT 1,
  `valid` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `apd` varchar(50) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.users: ~8 rows (aproximadamente)
INSERT INTO `users` (`users_id`, `email`, `password`, `permission_id`, `valid`, `nome`, `apelido`, `data_nascimento`, `apd`, `facebook`, `instagram`, `telefone`) VALUES
	(118, 'teste', 'teste', 1, 0, 'teste', '', '0000-00-00', '', '', '', ''),
	(119, 'teixeira.nuno88@gmail.com', '1234', 3, 1, 'Nuno', 'Teixeira', '1988-08-27', '123456', 'asd', 'asd', '123456'),
	(126, 'nuno_jard@hotmail.com', '1234', 2, 0, 'Equipa', '', '0000-00-00', '', '', '', ''),
	(127, '1060735@isep.ipp.pt', '1234', 1, 0, 'User', '', '0000-00-00', '', '', '', ''),
	(130, 'teste', 'teste', 1, 0, 'teste', '', '0000-00-00', '', '', '', ''),
	(131, 'teixeira.nuno88@gmail.com', '1234', 3, 1, 'Nuno', 'Teixeira', '1988-08-27', '123456', 'asd', 'asd', '123456'),
	(132, 'nuno_jard@hotmail.com', '1234', 2, 0, 'Equipa', '', '0000-00-00', '', '', '', ''),
	(133, '1060735@isep.ipp.pt', '1234', 1, 0, 'User', '', '0000-00-00', '', '', '', '');

-- A despejar estrutura para tabela airsoftplanner.users_organizador
CREATE TABLE IF NOT EXISTS `users_organizador` (
  `users_organizador_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `organizador_id` int(10) NOT NULL,
  PRIMARY KEY (`users_organizador_id`),
  KEY `users_id` (`users_id`),
  KEY `organizador_id` (`organizador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela airsoftplanner.users_organizador: ~3 rows (aproximadamente)
INSERT INTO `users_organizador` (`users_organizador_id`, `users_id`, `organizador_id`) VALUES
	(1, 33, 1),
	(2, 6, 2),
	(3, 33, 2);


-- A despejar estrutura da base de dados para innergymailler
CREATE DATABASE IF NOT EXISTS `innergymailler` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `innergymailler`;

-- A despejar estrutura para tabela innergymailler.databasechangelog
CREATE TABLE IF NOT EXISTS `databasechangelog` (
  `ID` varchar(255) NOT NULL,
  `AUTHOR` varchar(255) NOT NULL,
  `FILENAME` varchar(255) NOT NULL,
  `DATEEXECUTED` datetime NOT NULL,
  `ORDEREXECUTED` int(11) NOT NULL,
  `EXECTYPE` varchar(10) NOT NULL,
  `MD5SUM` varchar(35) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `COMMENTS` varchar(255) DEFAULT NULL,
  `TAG` varchar(255) DEFAULT NULL,
  `LIQUIBASE` varchar(20) DEFAULT NULL,
  `CONTEXTS` varchar(255) DEFAULT NULL,
  `LABELS` varchar(255) DEFAULT NULL,
  `DEPLOYMENT_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.databasechangelog: ~6 rows (aproximadamente)
INSERT INTO `databasechangelog` (`ID`, `AUTHOR`, `FILENAME`, `DATEEXECUTED`, `ORDEREXECUTED`, `EXECTYPE`, `MD5SUM`, `DESCRIPTION`, `COMMENTS`, `TAG`, `LIQUIBASE`, `CONTEXTS`, `LABELS`, `DEPLOYMENT_ID`) VALUES
	('00000000000001', 'jhipster', 'config/liquibase/changelog/00000000000000_initial_schema.xml', '2022-07-06 16:45:46', 1, 'EXECUTED', '8:658597b0dcb1b385a19f0fef0aee9293', 'createTable tableName=jhi_user; createTable tableName=jhi_authority; createTable tableName=jhi_user_authority; addPrimaryKey tableName=jhi_user_authority; addForeignKeyConstraint baseTableName=jhi_user_authority, constraintName=fk_authority_name, ...', '', NULL, '4.6.1', NULL, NULL, '7122344609'),
	('20220114200359-1', 'jhipster', 'config/liquibase/changelog/20220114200359_added_entity_EmailSenderProps.xml', '2022-07-06 16:45:46', 3, 'EXECUTED', '8:a7d9ed7a943dae7b0ba65c2229443e00', 'createTable tableName=email_sender_props', '', NULL, '4.6.1', NULL, NULL, '7122344609'),
	('20220114200359-1-data', 'rui.teixeira', 'config/liquibase/changelog/20220114200359_added_entity_EmailSenderProps.xml', '2022-07-06 16:45:46', 4, 'EXECUTED', '8:81feff4cb46b49b319d4903d753c8889', 'loadData tableName=email_sender_props', '', NULL, '4.6.1', NULL, NULL, '7122344609'),
	('20220114192636-1', 'jhipster', 'config/liquibase/changelog/20220114192636_added_entity_EmailSendingHistory.xml', '2022-07-18 16:20:16', 5, 'EXECUTED', '8:61589fe4e16800545c46641c0137d052', 'createTable tableName=email_sending_history; dropDefaultValue columnName=mail_date, tableName=email_sending_history', '', NULL, '4.6.1', NULL, NULL, '8157615996'),
	('20220712112844-1', 'jhipster', 'config/liquibase/changelog/20220712112844_added_entity_SMSHistory.xml', '2022-07-18 16:20:16', 6, 'EXECUTED', '8:c29281fb511a492596844c9d0dddf2d5', 'createTable tableName=smshistory; dropDefaultValue columnName=sms_date, tableName=smshistory', '', NULL, '4.6.1', NULL, NULL, '8157615996'),
	('20220712112845-1', 'jhipster', 'config/liquibase/changelog/20220712112845_added_entity_SMSProps.xml', '2022-07-18 16:20:16', 7, 'EXECUTED', '8:e46bfb633ae3af19a9fde3a6fbe8974a', 'createTable tableName=sms_props', '', NULL, '4.6.1', NULL, NULL, '8157615996');

-- A despejar estrutura para tabela innergymailler.databasechangeloglock
CREATE TABLE IF NOT EXISTS `databasechangeloglock` (
  `ID` int(11) NOT NULL,
  `LOCKED` bit(1) NOT NULL,
  `LOCKGRANTED` datetime DEFAULT NULL,
  `LOCKEDBY` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.databasechangeloglock: ~0 rows (aproximadamente)
INSERT INTO `databasechangeloglock` (`ID`, `LOCKED`, `LOCKGRANTED`, `LOCKEDBY`) VALUES
	(1, b'1', '2022-08-17 22:04:08', 'LAPTOP-JS96VR86 (192.168.1.253)');

-- A despejar estrutura para tabela innergymailler.email_sender_props
CREATE TABLE IF NOT EXISTS `email_sender_props` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.email_sender_props: ~11 rows (aproximadamente)
INSERT INTO `email_sender_props` (`id`, `setting_key`, `setting_value`) VALUES
	(1, 'host', 'smtp.gmail.com'),
	(2, 'port', '587'),
	(3, 'username', 'teixeira.nuno88@gmail.com'),
	(4, 'password', 'ubmxjjgftelhdevb'),
	(5, 'protocol', 'smtp'),
	(6, 'mail.smtp.auth', 'true'),
	(7, 'mail.smtp.starttls.enable', 'true'),
	(8, 'mail.smtp.starttls.required', 'true'),
	(9, 'mail.smtp.ssl.trust', 'smtp.gmail.com'),
	(10, 'mail.smtp.ssl.protocols', 'TLSv1.2');

-- A despejar estrutura para tabela innergymailler.email_sending_history
CREATE TABLE IF NOT EXISTS `email_sending_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mail_from` varchar(255) DEFAULT NULL,
  `mail_to` varchar(255) NOT NULL,
  `mail_cc` varchar(255) DEFAULT NULL,
  `mail_bcc` varchar(255) DEFAULT NULL,
  `mail_date` datetime(6),
  `mail_status` varchar(255) NOT NULL,
  `error_message` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.email_sending_history: ~71 rows (aproximadamente)
INSERT INTO `email_sending_history` (`id`, `mail_from`, `mail_to`, `mail_cc`, `mail_bcc`, `mail_date`, `mail_status`, `error_message`) VALUES
	(1, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', '', 'nuno_jard@hotmail.com', '2022-07-18 15:34:30.000000', 'ERROR', 'Illegal address'),
	(2, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', NULL, 'nuno_jard@hotmail.com', '2022-07-18 15:34:44.000000', 'ERROR', 'Cc address must not be null'),
	(3, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', NULL, 'nuno_jard@hotmail.com', '2022-07-18 15:36:17.000000', 'SUCCESS', NULL),
	(4, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', '', 'nuno_jard@hotmail.com', '2022-07-18 15:36:56.000000', 'ERROR', 'Illegal address'),
	(11, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', 'A@A.PT', 'nuno_jard@hotmail.com', '2022-07-18 18:45:35.000000', 'SUCCESS', NULL),
	(13, '', '1060asfasfsfs735@isep.ipp.pt', 'A@A.PT', 'nuno_jard@hotmail.com', '2022-07-18 18:48:29.000000', 'ERROR', 'Illegal address'),
	(14, NULL, '1060735@isep.ipp.pt', 'A@A.PT', 'nuno_jard@hotmail.com', '2022-07-19 21:21:54.000000', 'ERROR', 'Illegal address'),
	(17, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-07-19 21:56:05.000000', 'SUCCESS', NULL),
	(18, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-07-28 18:48:16.000000', 'SUCCESS', NULL),
	(19, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:31:10.000000', 'SUCCESS', NULL),
	(20, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:31:13.000000', 'SUCCESS', NULL),
	(21, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:31:16.000000', 'SUCCESS', NULL),
	(22, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:38:06.000000', 'SUCCESS', NULL),
	(23, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:38:11.000000', 'SUCCESS', NULL),
	(24, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:38:14.000000', 'SUCCESS', NULL),
	(25, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:38:57.000000', 'SUCCESS', NULL),
	(26, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:00.000000', 'SUCCESS', NULL),
	(27, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:03.000000', 'SUCCESS', NULL),
	(28, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:06.000000', 'SUCCESS', NULL),
	(29, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:09.000000', 'SUCCESS', NULL),
	(30, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:12.000000', 'SUCCESS', NULL),
	(31, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:15.000000', 'SUCCESS', NULL),
	(32, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:18.000000', 'SUCCESS', NULL),
	(33, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:21.000000', 'SUCCESS', NULL),
	(34, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:23.000000', 'SUCCESS', NULL),
	(35, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:27.000000', 'SUCCESS', NULL),
	(36, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-07 20:39:39.000000', 'SUCCESS', NULL),
	(37, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-08 01:44:23.000000', 'SUCCESS', NULL),
	(38, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-08 01:45:13.000000', 'SUCCESS', NULL),
	(39, 'teixeira.nuno88@gmail.com', '1060735@isep.ipp.pt', NULL, NULL, '2022-08-08 01:48:04.000000', 'SUCCESS', NULL),
	(40, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:48:46.000000', 'ERROR', 'From address must not be null'),
	(41, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:50:21.000000', 'ERROR', 'From address must not be null'),
	(42, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:53:08.000000', 'ERROR', 'From address must not be null'),
	(43, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:57:12.000000', 'ERROR', 'From address must not be null'),
	(44, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:57:31.000000', 'ERROR', 'From address must not be null'),
	(45, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 15:59:25.000000', 'ERROR', 'From address must not be null'),
	(46, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:04:33.000000', 'ERROR', 'From address must not be null'),
	(47, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:17:22.000000', 'ERROR', 'From address must not be null'),
	(48, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:17:33.000000', 'ERROR', 'From address must not be null'),
	(49, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:18:32.000000', 'ERROR', 'From address must not be null'),
	(50, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:22:41.000000', 'ERROR', 'From address must not be null'),
	(51, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:23:38.000000', 'ERROR', 'From address must not be null'),
	(52, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:24:11.000000', 'ERROR', 'From address must not be null'),
	(53, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:29:11.000000', 'ERROR', 'From address must not be null'),
	(54, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:29:57.000000', 'ERROR', 'From address must not be null'),
	(55, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:31:00.000000', 'ERROR', 'From address must not be null'),
	(56, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:31:33.000000', 'ERROR', 'From address must not be null'),
	(57, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:34:16.000000', 'ERROR', 'From address must not be null'),
	(58, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:34:36.000000', 'ERROR', 'From address must not be null'),
	(59, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:35:18.000000', 'ERROR', 'From address must not be null'),
	(60, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:35:24.000000', 'ERROR', 'From address must not be null'),
	(61, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:37:48.000000', 'ERROR', 'From address must not be null'),
	(62, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:39:44.000000', 'SUCCESS', NULL),
	(63, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:41:06.000000', 'SUCCESS', NULL),
	(64, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:41:34.000000', 'SUCCESS', NULL),
	(65, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:49:26.000000', 'ERROR', 'From address must not be null'),
	(66, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:49:58.000000', 'ERROR', 'From address must not be null'),
	(67, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:50:14.000000', 'ERROR', 'From address must not be null'),
	(68, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:50:44.000000', 'ERROR', 'From address must not be null'),
	(69, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:51:10.000000', 'ERROR', 'From address must not be null'),
	(70, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:51:58.000000', 'ERROR', 'From address must not be null'),
	(71, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:52:38.000000', 'ERROR', 'From address must not be null'),
	(72, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:55:21.000000', 'ERROR', 'From address must not be null'),
	(73, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:56:03.000000', 'ERROR', 'From address must not be null'),
	(74, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:58:39.000000', 'ERROR', 'From address must not be null'),
	(75, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 16:59:23.000000', 'ERROR', 'From address must not be null'),
	(76, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:00:27.000000', 'ERROR', 'From address must not be null'),
	(77, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:02:54.000000', 'ERROR', 'From address must not be null'),
	(78, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:04:05.000000', 'ERROR', 'From address must not be null'),
	(79, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:05:10.000000', 'ERROR', 'From address must not be null'),
	(80, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:05:32.000000', 'ERROR', 'From address must not be null'),
	(81, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:05:47.000000', 'ERROR', 'From address must not be null'),
	(82, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:06:33.000000', 'ERROR', 'From address must not be null'),
	(83, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:07:18.000000', 'SUCCESS', NULL),
	(84, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-16 17:08:17.000000', 'SUCCESS', NULL),
	(85, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-17 19:52:25.000000', 'SUCCESS', NULL),
	(86, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-17 20:49:36.000000', 'SUCCESS', NULL),
	(87, NULL, '1060735@isep.ipp.pt', NULL, NULL, '2022-08-17 20:52:50.000000', 'SUCCESS', NULL),
	(88, NULL, '1060735@isep.ipp.pt', 'nuno_jard@hotmail.com', NULL, '2022-08-29 19:34:54.000000', 'SUCCESS', NULL),
	(89, NULL, '1060735@isep.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno@gmail.com', '2022-08-29 19:35:22.000000', 'SUCCESS', NULL),
	(90, NULL, '1060735@isep.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno@gmail.com', '2022-09-29 16:33:01.000000', 'SUCCESS', NULL),
	(91, NULL, '1060735@isep.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:34:03.000000', 'SUCCESS', NULL),
	(92, NULL, '1060735@isep.ipp.pt@', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:35:02.000000', 'ERROR', 'Domain contains illegal character'),
	(93, NULL, '1060735afsafgasgasdg@isep.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:35:22.000000', 'SUCCESS', NULL),
	(94, NULL, '1060735@isep..ipp.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:35:42.000000', 'ERROR', 'Domain contains dot-dot'),
	(95, NULL, '1060735@isep.ipp.pt@', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:54:23.000000', 'ERROR', 'Domain contains illegal character'),
	(96, NULL, '1060735@isep.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno@gmail.com', '2022-09-29 16:54:36.000000', 'SUCCESS', NULL),
	(97, NULL, '1060735@isep..ipp.ipp.pt', 'nuno_jard@hotmail.com', 'teixeira.nuno88@gmail.com', '2022-09-29 16:54:47.000000', 'ERROR', 'Domain contains dot-dot');

-- A despejar estrutura para tabela innergymailler.jhi_authority
CREATE TABLE IF NOT EXISTS `jhi_authority` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.jhi_authority: ~2 rows (aproximadamente)
INSERT INTO `jhi_authority` (`name`) VALUES
	('ROLE_ADMIN'),
	('ROLE_USER');

-- A despejar estrutura para tabela innergymailler.jhi_user
CREATE TABLE IF NOT EXISTS `jhi_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `image_url` varchar(256) DEFAULT NULL,
  `activated` bit(1) NOT NULL,
  `lang_key` varchar(10) DEFAULT NULL,
  `activation_key` varchar(20) DEFAULT NULL,
  `reset_key` varchar(20) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date` timestamp NULL,
  `reset_date` timestamp NULL DEFAULT NULL,
  `last_modified_by` varchar(50) DEFAULT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_user_login` (`login`),
  UNIQUE KEY `ux_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.jhi_user: ~2 rows (aproximadamente)
INSERT INTO `jhi_user` (`id`, `login`, `password_hash`, `first_name`, `last_name`, `email`, `image_url`, `activated`, `lang_key`, `activation_key`, `reset_key`, `created_by`, `created_date`, `reset_date`, `last_modified_by`, `last_modified_date`) VALUES
	(1, 'admin', '$2a$10$gSAhZrxMllrbgj/kkK9UceBPpChGWJA7SYIb1Mqo.n5aNLq1/oRrC', 'Administrator', 'Administrator', 'admin@localhost', '', b'1', 'pt-pt', NULL, NULL, 'system', NULL, NULL, 'system', NULL),
	(2, 'user', '$2a$10$VEjxo0jq2YG9Rbk2HmX9S.k1uZBGYUHdUcid3g/vfiEl7lwWgOH/K', 'User', 'User', 'user@localhost', '', b'1', 'pt-pt', NULL, NULL, 'system', NULL, NULL, 'system', NULL);

-- A despejar estrutura para tabela innergymailler.jhi_user_authority
CREATE TABLE IF NOT EXISTS `jhi_user_authority` (
  `user_id` bigint(20) NOT NULL,
  `authority_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`authority_name`),
  KEY `fk_authority_name` (`authority_name`),
  CONSTRAINT `fk_authority_name` FOREIGN KEY (`authority_name`) REFERENCES `jhi_authority` (`name`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `jhi_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.jhi_user_authority: ~3 rows (aproximadamente)
INSERT INTO `jhi_user_authority` (`user_id`, `authority_name`) VALUES
	(1, 'ROLE_ADMIN'),
	(1, 'ROLE_USER'),
	(2, 'ROLE_USER');

-- A despejar estrutura para tabela innergymailler.sms_history
CREATE TABLE IF NOT EXISTS `sms_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_from` varchar(255) NOT NULL,
  `sms_to` varchar(255) NOT NULL,
  `sms_date` datetime(6),
  `sms_status` varchar(255) NOT NULL,
  `error_message` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.sms_history: ~28 rows (aproximadamente)
INSERT INTO `sms_history` (`id`, `sms_from`, `sms_to`, `sms_date`, `sms_status`, `error_message`) VALUES
	(1, '+15078794848', '+351917737010', '2022-07-18 17:59:39.000000', 'SUCCESS', NULL),
	(4, '+15078794848', '+35191010', '2022-07-18 19:48:32.000000', 'ERROR', 'The \'To\' number +35191010 is not a valid phone number.'),
	(5, 'SMSProps{id=9, settingKey=\'ORIGIN_PHONE_NUMBER\', settingValue=\'+15078794848\'}', '+351917737010', '2022-07-19 23:17:17.000000', 'ERROR', 'Authentication Error - invalid username'),
	(8, 'SMSProps{id=9, settingKey=\'ORIGIN_PHONE_NUMBER\', settingValue=\'+15078794848\'}', '+351917737010', '2022-07-19 23:26:34.000000', 'ERROR', 'Authentication Error - invalid username'),
	(9, '+15078794848', '+351917737010', '2022-07-19 23:38:28.000000', 'SUCCESS', NULL),
	(10, '+15078794848', '00351917737010', '2022-07-19 23:39:23.000000', 'ERROR', 'The \'To\' number 00351917737010 is not a valid phone number.'),
	(11, '+15078794848', '917737010', '2022-07-19 23:39:44.000000', 'ERROR', 'The \'To\' number 917737010 is not a valid phone number.'),
	(12, '+15078794848', '917737010', '2022-07-27 16:30:07.000000', 'ERROR', 'The \'To\' number 917737010 is not a valid phone number.'),
	(13, '+15078794848', '+351917737010', '2022-07-27 16:30:20.000000', 'SUCCESS', NULL),
	(14, '+15078794848', '+351917737010', '2022-08-07 22:14:55.000000', 'SUCCESS', NULL),
	(15, '+15078794848', '+351917737010', '2022-08-07 22:39:54.000000', 'SUCCESS', NULL),
	(16, '+15078794848', '+351917737010', '2022-08-08 22:29:18.000000', 'SUCCESS', NULL),
	(17, '+15078794848', '+351917737010', '2022-08-09 00:38:15.000000', 'SUCCESS', NULL),
	(19, '+15078794848', '+351917737010', '2022-08-16 15:52:05.000000', 'SUCCESS', NULL),
	(20, '+15078794848', '+351917737010', '2022-08-16 16:55:58.000000', 'SUCCESS', NULL),
	(21, '+15078794848', '+351917737010', '2022-08-16 17:01:30.000000', 'SUCCESS', NULL),
	(22, '+15078794848', '+351917737010', '2022-08-17 19:52:22.000000', 'SUCCESS', NULL),
	(23, '+15078794848', '+351917737010', '2022-08-17 20:20:34.000000', 'SUCCESS', NULL),
	(24, '+15078794848', '+351917737010', '2022-08-17 20:48:54.000000', 'SUCCESS', NULL),
	(25, '+15078794848', '+351917737010', '2022-08-17 20:49:06.000000', 'SUCCESS', NULL),
	(26, '+15078794848', '917737010', '2022-09-29 16:36:12.000000', 'ERROR', 'The \'To\' number 917737010 is not a valid phone number.'),
	(27, '+15078794848', '+35191773701000', '2022-09-29 16:36:30.000000', 'ERROR', 'The \'To\' number +35191773701000 is not a valid phone number.'),
	(28, '+15078794848', '+351911737010', '2022-09-29 16:36:50.000000', 'ERROR', 'The number  is unverified. Trial accounts cannot send messages to unverified numbers; verify  at twilio.com/user/account/phone-numbers/verified, or purchase a Twilio number to send messages to unverified numbers.'),
	(29, '+15078794848', '+35191737010', '2022-09-29 16:37:01.000000', 'ERROR', 'The \'To\' number +35191737010 is not a valid phone number.'),
	(30, '+15078794848', '+351917737010', '2022-09-29 16:37:09.000000', 'SUCCESS', NULL),
	(31, '+15078794848', '+351917737010123', '2022-09-29 17:04:53.000000', 'ERROR', 'The \'To\' number +351917737010123 is not a valid phone number.'),
	(32, '+15078794848', '917737010', '2022-09-29 17:04:59.000000', 'ERROR', 'The \'To\' number 917737010 is not a valid phone number.'),
	(33, '+15078794848', '+351917737010', '2022-09-29 17:10:18.000000', 'SUCCESS', NULL),
	(34, '+15078794848', '+351917737010', '2022-09-29 17:10:28.000000', 'SUCCESS', NULL);

-- A despejar estrutura para tabela innergymailler.sms_props
CREATE TABLE IF NOT EXISTS `sms_props` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela innergymailler.sms_props: ~5 rows (aproximadamente)
INSERT INTO `sms_props` (`id`, `setting_key`, `setting_value`) VALUES
	(5, 'USERNAME', 'teixeira.nuno88@gmail.com'),
	(6, 'PASSWORD', 'JARDreddevil_10%'),
	(7, 'ACCOUNT_SID', 'ACef846a8f5f3a07ae3246486fef91e8bf'),
	(8, 'AUTH_TOKEN', '10f3f83e2940254de0644b2ffa97f1e6'),
	(9, 'ORIGIN_PHONE_NUMBER', '+15078794848');


-- A despejar estrutura da base de dados para iptvplanner
CREATE DATABASE IF NOT EXISTS `iptvplanner` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `iptvplanner`;

-- A despejar estrutura para tabela iptvplanner.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissions_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permissions_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.permissions: ~3 rows (aproximadamente)
INSERT INTO `permissions` (`permissions_id`, `nome`) VALUES
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
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- A despejar dados para tabela iptvplanner.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`users_id`, `email`, `password`, `permission_id`, `valid`, `nome`, `apelido`, `data_nascimento`, `telefone`) VALUES
	(1, 'teixeira.nuno88@gmail.com', '1234', 3, 1, 'Nuno', 'Teixeira', '1988-08-27', '917737010');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
