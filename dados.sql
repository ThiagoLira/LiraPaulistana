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
INSERT INTO `Aluno` VALUES (4);
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
  CONSTRAINT `fk_aula_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_evento` FOREIGN KEY (`eventoId`) REFERENCES `evento` (`eventoId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Aula`
--

LOCK TABLES `Aula` WRITE;
/*!40000 ALTER TABLE `Aula` DISABLE KEYS */;
INSERT INTO `Aula` VALUES (1,'Guitarra','Intermediário','1','Normal',0,4,3),(2,'Guitarra','Intermediário','3','Normal',0,4,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (1,'2015-06-17 14:00:00','14:00'),(2,'2015-06-19 18:00:00','18:00'),(3,'2015-06-28 21:00:00','21:00');
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
INSERT INTO `EventoMusical` VALUES (3,'Primeiro Sarau','A definir','Primeiro evento musical.');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Item`
--

LOCK TABLES `Item` WRITE;
/*!40000 ALTER TABLE `Item` DISABLE KEYS */;
INSERT INTO `Item` VALUES (1,'Vídeo exemplo','https://www.youtube.com/watch?v=dQw4w9WgXcQ','Vídeo',3,4),(2,'Teste #1','https://www.youtube.com/watch?v=ba7rRfKIHxU','Vídeo',3,4),(3,'Teste #2','https://www.youtube.com/watch?v=HiuFNyUZ9VI','Vídeo',3,4);
/*!40000 ALTER TABLE `Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Login`
--

DROP TABLE IF EXISTS `Login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Login` (
  `loginId` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `hash` varchar(60) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `fk_login_usuario_idx` (`usuarioId`),
  CONSTRAINT `fk_login_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Login`
--

LOCK TABLES `Login` WRITE;
/*!40000 ALTER TABLE `Login` DISABLE KEYS */;
INSERT INTO `Login` VALUES (0,'admin','senhaadmin',1),(1,'operador','senhaoperador',2),(2,'profguitarra','senhaprofguitarra',3),(4,'umaluno','senhaumaluno',4);
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
INSERT INTO `Professor` VALUES (3,'Guitarra','Faculdade 123','Aulas apenas para jovens e adultos');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TemAula`
--

LOCK TABLES `TemAula` WRITE;
/*!40000 ALTER TABLE `TemAula` DISABLE KEYS */;
INSERT INTO `TemAula` VALUES (1,4,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'Nome do Administrador','1980-01-10 00:00:00','00.000.000-0','000.000.000-00','Rua Exemplo, n 800','0','0','administrador@lirapaulistana.com.br',5),(2,'Nome de Operador','1985-06-30 00:00:00','11.111.111-1','111.111.111-11','Av. Exemplo, 411','11111111','111111111','operador@lirapaulistana.com.br',4),(3,'Professor de Guitarra','1987-03-04 00:00:00','22.222.222-2','222.222.222-22','Alameda Exemplo, 77','22222222','222222222','profdeguitarra@lirapaulistana.com.br',2),(4,'Um Aluno','1990-07-30 00:00:00','33.333.333-3','333.333.333-33','Rua ABCD','33333333','333333333','um_aluno@gmail.com',1);
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

-- Dump completed on 2015-06-17 15:18:05
