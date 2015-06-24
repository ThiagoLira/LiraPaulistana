-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: 127.0.0.1    Database: lirapaulistana
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Administrador`
--

DROP TABLE IF EXISTS `Administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Administrador` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_administrador_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administrador`
--

LOCK TABLES `Administrador` WRITE;
/*!40000 ALTER TABLE `Administrador` DISABLE KEYS */;
INSERT INTO `Administrador` VALUES (1);
/*!40000 ALTER TABLE `Administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Aluno`
--

DROP TABLE IF EXISTS `Aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aluno` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_aluno_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Aluno`
--

LOCK TABLES `Aluno` WRITE;
/*!40000 ALTER TABLE `Aluno` DISABLE KEYS */;
INSERT INTO `Aluno` VALUES (10),(11);
/*!40000 ALTER TABLE `Aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Aula`
--

DROP TABLE IF EXISTS `Aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aula` (
  `eventoId` int(11) NOT NULL,
  `instrumento` varchar(45) NOT NULL,
  `nivel` varchar(45) NOT NULL,
  `sala` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `presenca` int(11) NOT NULL,
  `alunoId` int(11) NOT NULL,
  `professorId` int(11) NOT NULL,
  PRIMARY KEY (`eventoId`),
  KEY `fk_aula_aluno_idx` (`alunoId`),
  KEY `fk_aula_professor_idx` (`professorId`),
  CONSTRAINT `fk_aula_evento` FOREIGN KEY (`eventoId`) REFERENCES `evento` (`eventoId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Aula`
--

LOCK TABLES `Aula` WRITE;
/*!40000 ALTER TABLE `Aula` DISABLE KEYS */;
INSERT INTO `Aula` VALUES (4,'Guitarra','Intermediário','1','Normal',0,10,6),(5,'Canto','Intermediário','4','Normal',0,11,5);
/*!40000 ALTER TABLE `Aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evento`
--

DROP TABLE IF EXISTS `Evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Evento` (
  `eventoId` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `horario` varchar(45) NOT NULL,
  PRIMARY KEY (`eventoId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (1,'2015-06-20 20:00:00','20:00'),(2,'2015-06-28 10:00:00','10:00'),(3,'2015-07-18 21:00:00','21:00'),(4,'2015-06-25 12:00:00','12:00'),(5,'2015-06-10 16:00:00','16:00');
/*!40000 ALTER TABLE `Evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventoMusical`
--

DROP TABLE IF EXISTS `EventoMusical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventoMusical` (
  `eventoId` int(11) NOT NULL,
  `nome` varchar(140) NOT NULL,
  `local` varchar(140) NOT NULL,
  `descricao` varchar(560) NOT NULL,
  PRIMARY KEY (`eventoId`),
  CONSTRAINT `fk_eventoMusical_evento` FOREIGN KEY (`eventoId`) REFERENCES `evento` (`eventoId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventoMusical`
--

LOCK TABLES `EventoMusical` WRITE;
/*!40000 ALTER TABLE `EventoMusical` DISABLE KEYS */;
INSERT INTO `EventoMusical` VALUES (1,'Primeiro Sarau','Lira Paulistana','Primeiro evento musical.'),(2,'Workshop de bateria','Lira Paulistana','Workshop de bateria, aberto a todos os alunos.'),(3,'Primeira Confraternização','Lira Paulistana','Primeira confraternização de alunos.');
/*!40000 ALTER TABLE `EventoMusical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Item`
--

DROP TABLE IF EXISTS `Item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Item` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(140) NOT NULL,
  `link` varchar(140) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `professorId` int(11) NOT NULL,
  `alunoId` int(11) NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `fk_item_professor_idx` (`professorId`),
  KEY `fk_item_aluno_idx` (`alunoId`),
  CONSTRAINT `fk_item_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Item`
--

LOCK TABLES `Item` WRITE;
/*!40000 ALTER TABLE `Item` DISABLE KEYS */;
INSERT INTO `Item` VALUES (1,'Vídeo #1','https://www.youtube.com/watch?v=DoZlujggIq0','Vídeo',6,10);
/*!40000 ALTER TABLE `Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Login`
--

DROP TABLE IF EXISTS `Login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Login` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `hash` varchar(60) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `fk_login_usuario_idx` (`usuarioId`),
  CONSTRAINT `fk_login_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Login`
--

LOCK TABLES `Login` WRITE;
/*!40000 ALTER TABLE `Login` DISABLE KEYS */;
INSERT INTO `Login` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1),(2,'operador','06d4f07c943a4da1c8bfe591abbc3579',2),(3,'profbaixo','7121ac79c0392096b97d635a53a2321d',3),(4,'profbateria','6120d9b6e6896d7fb6bfc3e2a4c54614',4),(5,'profcanto','b45875a2bc0f7ce1cf1202d28832b6ab',5),(6,'profguitarra','1b1b48a56143412b2f1de77674ee1581',6),(7,'profpiano','1f151cfe43c7c0a8277e04ca09601279',7),(8,'profteclado','e7dec9c1e625852580d152e8e55dc6fb',8),(9,'profviolao','9a2d514543993b77208a8852ca50526a',9),(10,'aluno','ca0cd09a12abade3bf0777574d9f987f',10),(11,'alunocanto','dd9a409b108fa26eb58671244c397f5f',11);
/*!40000 ALTER TABLE `Login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Operador`
--

DROP TABLE IF EXISTS `Operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Operador` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`),
  KEY `fk_operador_usuario_idx` (`usuarioId`),
  CONSTRAINT `fk_operador_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Operador`
--

LOCK TABLES `Operador` WRITE;
/*!40000 ALTER TABLE `Operador` DISABLE KEYS */;
INSERT INTO `Operador` VALUES (2);
/*!40000 ALTER TABLE `Operador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Professor`
--

DROP TABLE IF EXISTS `Professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Professor` (
  `usuarioId` int(11) NOT NULL,
  `instrumento` varchar(45) NOT NULL,
  `formacao` varchar(140) NOT NULL,
  `preferencias` varchar(280) DEFAULT NULL,
  PRIMARY KEY (`usuarioId`),
  KEY `fk_professor_usuario_idx` (`usuarioId`),
  CONSTRAINT `fk_professor_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Professor`
--

LOCK TABLES `Professor` WRITE;
/*!40000 ALTER TABLE `Professor` DISABLE KEYS */;
INSERT INTO `Professor` VALUES (3,'Baixo','Universidade A','Alunos avançados'),(4,'Bateria','Universidade B',''),(5,'Canto','Conservatório B',''),(6,'Guitarra','Faculdade Z','Jovens e adultos'),(7,'Piano','Conservatório C',''),(8,'Teclado','Universidade A',''),(9,'Violão','Universidade B','Alunos avançados');
/*!40000 ALTER TABLE `Professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TemAula`
--

DROP TABLE IF EXISTS `TemAula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TemAula` (
  `temAulaId` int(11) NOT NULL AUTO_INCREMENT,
  `alunoId` int(11) NOT NULL,
  `professorId` int(11) NOT NULL,
  PRIMARY KEY (`temAulaId`),
  KEY `fk_temAula_professor_idx` (`professorId`),
  KEY `fk_temAula_aluno_idx` (`alunoId`),
  CONSTRAINT `fk_temAula_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_temAula_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TemAula`
--

LOCK TABLES `TemAula` WRITE;
/*!40000 ALTER TABLE `TemAula` DISABLE KEYS */;
INSERT INTO `TemAula` VALUES (1,10,6),(2,11,5);
/*!40000 ALTER TABLE `TemAula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `usuarioId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(140) NOT NULL,
  `dataNascimento` datetime NOT NULL,
  `rg` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `endereco` varchar(280) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(140) NOT NULL,
  `grauPermissao` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'Nome do Administrador','1980-06-12 00:00:00','11.111.111-1','111.111.111-11','Rua Exemplo','(11) 1234-5678','(11) 91234-5678','admin@lirapaulistana.com.br',5),(2,'Nome do Operador','1980-06-19 00:00:00','22.222.222-2','222.222.222-22','Avenida Exemplo','(11) 2222-2222','(11) 99999-9999','operador@lirapaulistana.com.br',4),(3,'Professor de Baixo','1985-12-11 00:00:00','12.331.321-2','121.321.231-32','Rua 1234','(11) 2322-3232','(11) 22232-3233','profbaixo@gmail.com',1),(4,'Professor de Bateria','1988-01-01 00:00:00','13.234.423-4','234.234.234-32','Rua Exemplo #1','(11) 3453-4533','(11) 95434-5345','profbateria@gmail.com',1),(5,'Professor de Canto','1987-07-30 00:00:00','12.313.213-1','123.311.233-11','Avenida 345','(11) 4232-3234','(11) 94382-4728','profcanto@gmail.com',1),(6,'Professor de Guitarra','1979-06-06 00:00:00','12.252.524-2','345.352.112-31','Rua ABCD','(11) 3223-2323','(11) 98493-8942','profguitarra@gmail.com',1),(7,'Professor de Piano','1984-11-23 00:00:00','44.324.242-2','324.324.324-23','Alameda Exemplo','(11) 5443-5234','(11) 92344-3234','profpiano@gmail.com',1),(8,'Professor de Teclado','1988-10-10 00:00:00','45.435.445-3','757.564.634-53','Rua Exemplo #2','(11) 3534-2332','(11) 93482-3483','profteclado@gmail.com',1),(9,'Professor de Violão','1982-07-29 00:00:00','11.394.032-9','734.326.432-74','Rua 1234','(11) 3444-4444','(11) 94382-3482','profviolao@gmail.com',1),(10,'Aluno Exemplo','1990-10-11 00:00:00','43.354.656-5','423.553.422-00','Rua Exemplo #3','(11) 4344-3434','(11) 93498-9329','aluno@gmail.com',1),(11,'Aluno de Canto','1990-08-22 00:00:00','23.243.324-2','546.456.456-65','Rua Exemplo #1','(11) 6343-3242','(11) 44332-4234','aluno2@gmail.com',1);
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-24  1:28:26
