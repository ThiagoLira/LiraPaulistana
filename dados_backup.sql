-- phpMyAdmin SQL Dump
-- version 4.0.10.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2015 at 01:29 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lirapaulistana`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrador`
--

CREATE TABLE IF NOT EXISTS `Administrador` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Administrador`
--

INSERT INTO `Administrador` (`usuarioId`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `Aluno`
--

CREATE TABLE IF NOT EXISTS `Aluno` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Aluno`
--

INSERT INTO `Aluno` (`usuarioId`) VALUES
(10),
(11);

-- --------------------------------------------------------

--
-- Table structure for table `Aula`
--

CREATE TABLE IF NOT EXISTS `Aula` (
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
  KEY `fk_aula_professor_idx` (`professorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Aula`
--

INSERT INTO `Aula` (`eventoId`, `instrumento`, `nivel`, `sala`, `tipo`, `presenca`, `alunoId`, `professorId`) VALUES
(4, 'Guitarra', 'Intermediário', '1', 'Normal', 0, 10, 6),
(5, 'Canto', 'Intermediário', '4', 'Normal', 0, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `eventoId` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `horario` varchar(45) NOT NULL,
  PRIMARY KEY (`eventoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Evento`
--

INSERT INTO `Evento` (`eventoId`, `data`, `horario`) VALUES
(1, '2015-06-20 20:00:00', '20:00'),
(2, '2015-06-28 10:00:00', '10:00'),
(3, '2015-07-18 21:00:00', '21:00'),
(4, '2015-06-25 12:00:00', '12:00'),
(5, '2015-06-10 16:00:00', '16:00');

-- --------------------------------------------------------

--
-- Table structure for table `EventoMusical`
--

CREATE TABLE IF NOT EXISTS `EventoMusical` (
  `eventoId` int(11) NOT NULL,
  `nome` varchar(140) NOT NULL,
  `local` varchar(140) NOT NULL,
  `descricao` varchar(560) NOT NULL,
  PRIMARY KEY (`eventoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EventoMusical`
--

INSERT INTO `EventoMusical` (`eventoId`, `nome`, `local`, `descricao`) VALUES
(1, 'Primeiro Sarau', 'Lira Paulistana', 'Primeiro evento musical.'),
(2, 'Workshop de bateria', 'Lira Paulistana', 'Workshop de bateria, aberto a todos os alunos.'),
(3, 'Primeira Confraternização', 'Lira Paulistana', 'Primeira confraternização de alunos.');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE IF NOT EXISTS `Item` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(140) NOT NULL,
  `link` varchar(140) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `professorId` int(11) NOT NULL,
  `alunoId` int(11) NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `fk_item_professor_idx` (`professorId`),
  KEY `fk_item_aluno_idx` (`alunoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`itemId`, `nome`, `link`, `tipo`, `professorId`, `alunoId`) VALUES
(1, 'Vídeo #1', 'https://www.youtube.com/watch?v=DoZlujggIq0', 'Vídeo', 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE IF NOT EXISTS `Login` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `hash` varchar(60) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `fk_login_usuario_idx` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`loginId`, `username`, `hash`, `usuarioId`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'operador', '06d4f07c943a4da1c8bfe591abbc3579', 2),
(3, 'profbaixo', '7121ac79c0392096b97d635a53a2321d', 3),
(4, 'profbateria', '6120d9b6e6896d7fb6bfc3e2a4c54614', 4),
(5, 'profcanto', 'b45875a2bc0f7ce1cf1202d28832b6ab', 5),
(6, 'profguitarra', '1b1b48a56143412b2f1de77674ee1581', 6),
(7, 'profpiano', '1f151cfe43c7c0a8277e04ca09601279', 7),
(8, 'profteclado', 'e7dec9c1e625852580d152e8e55dc6fb', 8),
(9, 'profviolao', '9a2d514543993b77208a8852ca50526a', 9),
(10, 'aluno', 'ca0cd09a12abade3bf0777574d9f987f', 10),
(11, 'alunocanto', 'dd9a409b108fa26eb58671244c397f5f', 11);

-- --------------------------------------------------------

--
-- Table structure for table `Operador`
--

CREATE TABLE IF NOT EXISTS `Operador` (
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`),
  KEY `fk_operador_usuario_idx` (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Operador`
--

INSERT INTO `Operador` (`usuarioId`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `Professor`
--

CREATE TABLE IF NOT EXISTS `Professor` (
  `usuarioId` int(11) NOT NULL,
  `instrumento` varchar(45) NOT NULL,
  `formacao` varchar(140) NOT NULL,
  `preferencias` varchar(280) DEFAULT NULL,
  PRIMARY KEY (`usuarioId`),
  KEY `fk_professor_usuario_idx` (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Professor`
--

INSERT INTO `Professor` (`usuarioId`, `instrumento`, `formacao`, `preferencias`) VALUES
(3, 'Baixo', 'Universidade A', 'Alunos avançados'),
(4, 'Bateria', 'Universidade B', ''),
(5, 'Canto', 'Conservatório B', ''),
(6, 'Guitarra', 'Faculdade Z', 'Jovens e adultos'),
(7, 'Piano', 'Conservatório C', ''),
(8, 'Teclado', 'Universidade A', ''),
(9, 'Violão', 'Universidade B', 'Alunos avançados');

-- --------------------------------------------------------

--
-- Table structure for table `TemAula`
--

CREATE TABLE IF NOT EXISTS `TemAula` (
  `temAulaId` int(11) NOT NULL AUTO_INCREMENT,
  `alunoId` int(11) NOT NULL,
  `professorId` int(11) NOT NULL,
  PRIMARY KEY (`temAulaId`),
  KEY `fk_temAula_professor_idx` (`professorId`),
  KEY `fk_temAula_aluno_idx` (`alunoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `TemAula`
--

INSERT INTO `TemAula` (`temAulaId`, `alunoId`, `professorId`) VALUES
(1, 10, 6),
(2, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`usuarioId`, `nome`, `dataNascimento`, `rg`, `cpf`, `endereco`, `telefone`, `celular`, `email`, `grauPermissao`) VALUES
(1, 'Nome do Administrador', '1980-06-12 00:00:00', '11.111.111-1', '111.111.111-11', 'Rua Exemplo', '(11) 1234-5678', '(11) 91234-5678', 'admin@lirapaulistana.com.br', 5),
(2, 'Nome do Operador', '1980-06-19 00:00:00', '22.222.222-2', '222.222.222-22', 'Avenida Exemplo', '(11) 2222-2222', '(11) 99999-9999', 'operador@lirapaulistana.com.br', 4),
(3, 'Professor de Baixo', '1985-12-11 00:00:00', '12.331.321-2', '121.321.231-32', 'Rua 1234', '(11) 2322-3232', '(11) 22232-3233', 'profbaixo@gmail.com', 1),
(4, 'Professor de Bateria', '1988-01-01 00:00:00', '13.234.423-4', '234.234.234-32', 'Rua Exemplo #1', '(11) 3453-4533', '(11) 95434-5345', 'profbateria@gmail.com', 1),
(5, 'Professor de Canto', '1987-07-30 00:00:00', '12.313.213-1', '123.311.233-11', 'Avenida 345', '(11) 4232-3234', '(11) 94382-4728', 'profcanto@gmail.com', 1),
(6, 'Professor de Guitarra', '1979-06-06 00:00:00', '12.252.524-2', '345.352.112-31', 'Rua ABCD', '(11) 3223-2323', '(11) 98493-8942', 'profguitarra@gmail.com', 1),
(7, 'Professor de Piano', '1984-11-23 00:00:00', '44.324.242-2', '324.324.324-23', 'Alameda Exemplo', '(11) 5443-5234', '(11) 92344-3234', 'profpiano@gmail.com', 1),
(8, 'Professor de Teclado', '1988-10-10 00:00:00', '45.435.445-3', '757.564.634-53', 'Rua Exemplo #2', '(11) 3534-2332', '(11) 93482-3483', 'profteclado@gmail.com', 1),
(9, 'Professor de Violão', '1982-07-29 00:00:00', '11.394.032-9', '734.326.432-74', 'Rua 1234', '(11) 3444-4444', '(11) 94382-3482', 'profviolao@gmail.com', 1),
(10, 'Aluno Exemplo', '1990-10-11 00:00:00', '43.354.656-5', '423.553.422-00', 'Rua Exemplo #3', '(11) 4344-3434', '(11) 93498-9329', 'aluno@gmail.com', 1),
(11, 'Aluno de Canto', '1990-08-22 00:00:00', '23.243.324-2', '546.456.456-65', 'Rua Exemplo #1', '(11) 6343-3242', '(11) 44332-4234', 'aluno2@gmail.com', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Administrador`
--
ALTER TABLE `Administrador`
  ADD CONSTRAINT `fk_administrador_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Aluno`
--
ALTER TABLE `Aluno`
  ADD CONSTRAINT `fk_aluno_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Aula`
--
ALTER TABLE `Aula`
  ADD CONSTRAINT `fk_aula_evento` FOREIGN KEY (`eventoId`) REFERENCES `evento` (`eventoId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aula_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aula_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `EventoMusical`
--
ALTER TABLE `EventoMusical`
  ADD CONSTRAINT `fk_eventoMusical_evento` FOREIGN KEY (`eventoId`) REFERENCES `evento` (`eventoId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `fk_item_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `fk_login_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Operador`
--
ALTER TABLE `Operador`
  ADD CONSTRAINT `fk_operador_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Professor`
--
ALTER TABLE `Professor`
  ADD CONSTRAINT `fk_professor_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `TemAula`
--
ALTER TABLE `TemAula`
  ADD CONSTRAINT `fk_temAula_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_temAula_professor` FOREIGN KEY (`professorId`) REFERENCES `professor` (`usuarioId`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
