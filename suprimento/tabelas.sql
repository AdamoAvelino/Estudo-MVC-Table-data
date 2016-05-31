-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.47-0ubuntu0.14.04.1 - (Ubuntu)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para blogretro
DROP DATABASE IF EXISTS `blogretro`;
CREATE DATABASE IF NOT EXISTS `blogretro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `blogretro`;


-- Copiando estrutura para tabela blogretro.artigos
DROP TABLE IF EXISTS `artigos`;
CREATE TABLE IF NOT EXISTS `artigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` int(11) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `autor` smallint(6) DEFAULT NULL,
  `conteudo` longtext,
  `categoria` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela blogretro.artigos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `artigos` DISABLE KEYS */;
INSERT INTO `artigos` (`id`, `media`, `link`, `titulo`, `autor`, `conteudo`, `categoria`, `data`) VALUES
	(1, 4, NULL, 'IPUHYUIPHUILsdÃ§lk', 1, '<p>&ccedil;dxthyj&ccedil;shjs&ccedil;ohjisoji</p>', 7, '2016-05-31'),
	(2, 6, NULL, 'sighlszkjhzlhzlh', 1, '<p>a&ccedil;gthrjlszhjlshjlj&ccedil;sjgbhls</p>', 12, '2016-05-31');
/*!40000 ALTER TABLE `artigos` ENABLE KEYS */;


-- Copiando estrutura para tabela blogretro.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela blogretro.categoria: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nome`) VALUES
	(0, 'avelino'),
	(1, 'Nova Categoria'),
	(2, 'Adamo'),
	(3, 'easthsgjwsjy'),
	(4, 'aetye5yui47i'),
	(5, 'Ctegoria doida'),
	(6, 'treta categoria'),
	(7, 'Nova Categoria de inclusÃ£o'),
	(8, 'Garantia Teste'),
	(9, 'Teste Definitivo ProvisÃ³rio'),
	(10, 'Eita'),
	(11, 'Sei la'),
	(12, 'depois de tudo');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


-- Copiando estrutura para tabela blogretro.media
DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela blogretro.media: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `tipo`, `url`) VALUES
	(1, 'imagem', '/web-admin/imagens/AoF33IjUDebnys2_26ujBOVrodedL3cn70gMyWCFaOSp.jpg'),
	(2, 'imagem', '/web-admin/imagens/Buffet-casamento-fotos.jpg'),
	(3, 'imagem', '/web-admin/imagens/AoF33IjUDebnys2_26ujBOVrodedL3cn70gMyWCFaOSp_copia.jpg'),
	(4, 'imagem', '/web-admin/imagens/background.png'),
	(5, 'imagem', '/web-admin/imagens/Sem tÃ­tulo.png'),
	(6, 'imagem', '/web-admin/imagens/Captura de tela de 2016-03-22 21:50:19.png'),
	(7, 'imagem', '/web-admin/imagens/slider_tacas.png'),
	(8, 'imagem', '/web-admin/imagens/Buffet-casamento-fotos_copia.jpg'),
	(9, 'imagem', '/web-admin/imagens/Captura de tela de 2016-02-12 21:03:19.png'),
	(10, 'imagem', '/web-admin/imagens/Captura de tela de 2016-02-04 22:27:04.png'),
	(11, 'imagem', '/web-admin/imagens/Captura de tela de 2016-03-12 18:52:32.png'),
	(12, 'imagem', '/web-admin/imagens/abstract-q-c-640-480-3.jpg'),
	(13, 'imagem', '/web-admin/imagens/nightlife-q-c-640-480-4.jpg'),
	(14, 'imagem', '/web-admin/imagens/people-q-c-640-480-7.jpg'),
	(15, 'imagem', '/web-admin/imagens/nightlife-q-c-640-480-6.jpg'),
	(16, 'imagem', '/web-admin/imagens/abstract-q-c-640-480-9.jpg'),
	(17, 'imagem', '/web-admin/imagens/nightlife-q-c-640-480-5.jpg'),
	(18, 'imagem', '/web-admin/imagens/abstract-q-c-640-480-8.jpg'),
	(19, 'imagem', '/web-admin/imagens/people-q-c-640-480-4.jpg'),
	(20, 'imagem', '/web-admin/imagens/1838832-116062-1280.jpg');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;


-- Copiando estrutura para tabela blogretro.perfil_usuario
DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) DEFAULT NULL,
  `editar_artigo` tinyint(1) DEFAULT NULL,
  `incluir_artigo` tinyint(1) DEFAULT NULL,
  `incluir_usuario` tinyint(1) DEFAULT NULL,
  `editar_usuario` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela blogretro.perfil_usuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil_usuario` DISABLE KEYS */;
INSERT INTO `perfil_usuario` (`id`, `perfil`, `editar_artigo`, `incluir_artigo`, `incluir_usuario`, `editar_usuario`) VALUES
	(1, 'administrador', 1, 1, 1, 1),
	(2, 'editor', 1, 1, 0, 0),
	(3, 'revisor', 1, 0, 0, 0);
/*!40000 ALTER TABLE `perfil_usuario` ENABLE KEYS */;


-- Copiando estrutura para tabela blogretro.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela blogretro.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `perfil`, `email`, `senha`, `nome`) VALUES
	(1, 1, 'adamo.avelino@gmail.com', '12345', 'Adamo'),
	(2, 2, 'larissa@lkagh.com', '10203040', 'Larissa');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
