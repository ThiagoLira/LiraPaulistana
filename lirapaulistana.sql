-- MySQL Script generated by MySQL Workbench
-- Wed May 27 20:53:02 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema lirapaulistana
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema lirapaulistana
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `lirapaulistana` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lirapaulistana` ;

-- -----------------------------------------------------
-- Table `lirapaulistana`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Usuario` (
  `usuarioId` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(140) NOT NULL,
  `dataNascimento` DATETIME NOT NULL,
  `rg` INT NOT NULL,
  `cpf` INT NOT NULL,
  `endereco` VARCHAR(280) NOT NULL,
  `telefone` INT NOT NULL,
  `celular` INT NOT NULL,
  `email` VARCHAR(140) NOT NULL,
  `grauPermissao` INT NOT NULL,
  PRIMARY KEY (`usuarioId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Professor` (
  `usuarioId` INT NOT NULL,
  `instrumento` VARCHAR(45) NOT NULL,
  `formacao` VARCHAR(140) NOT NULL,
  `preferencias` VARCHAR(280) NULL,
  INDEX `fk_professor_usuario_idx` (`usuarioId` ASC),
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_professor_usuario`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `lirapaulistana`.`Usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Aluno` (
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_aluno_usuario`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `lirapaulistana`.`Usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Administrador` (
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_administrador_usuario`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `lirapaulistana`.`Usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Login` (
  `loginId` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `hash` VARCHAR(60) NOT NULL,
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`loginId`),
  INDEX `fk_login_usuario_idx` (`usuarioId` ASC),
  CONSTRAINT `fk_login_usuario`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `lirapaulistana`.`Usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Item` (
  `itemId` INT NOT NULL AUTO_INCREMENT,
  `link` VARCHAR(140) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `professorId` INT NOT NULL,
  `alunoId` INT NOT NULL,
  PRIMARY KEY (`itemId`),
  INDEX `fk_item_professor_idx` (`professorId` ASC),
  INDEX `fk_item_aluno_idx` (`alunoId` ASC),
  CONSTRAINT `fk_item_aluno`
    FOREIGN KEY (`alunoId`)
    REFERENCES `lirapaulistana`.`Aluno` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_professor`
    FOREIGN KEY (`professorId`)
    REFERENCES `lirapaulistana`.`Professor` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`TemAula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`TemAula` (
  `temAulaId` INT NOT NULL AUTO_INCREMENT,
  `alunoId` INT NOT NULL,
  `professorId` INT NOT NULL,
  PRIMARY KEY (`temAulaId`),
  INDEX `fk_temAula_professor_idx` (`professorId` ASC),
  INDEX `fk_temAula_aluno_idx` (`alunoId` ASC),
  CONSTRAINT `fk_temAula_aluno`
    FOREIGN KEY (`alunoId`)
    REFERENCES `lirapaulistana`.`Aluno` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_temAula_professor`
    FOREIGN KEY (`professorId`)
    REFERENCES `lirapaulistana`.`Professor` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Evento` (
  `eventoId` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME NOT NULL,
  `horario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eventoId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Aula` (
  `eventoId` INT NOT NULL,
  `instrumento` VARCHAR(45) NOT NULL,
  `nivel` VARCHAR(45) NOT NULL,
  `sala` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `presenca` INT NOT NULL,
  `alunoId` INT NOT NULL,
  `professorId` INT NOT NULL,
  PRIMARY KEY (`eventoId`),
  INDEX `fk_aula_aluno_idx` (`alunoId` ASC),
  INDEX `fk_aula_professor_idx` (`professorId` ASC),
  CONSTRAINT `fk_aula_evento`
    FOREIGN KEY (`eventoId`)
    REFERENCES `lirapaulistana`.`Evento` (`eventoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_aluno`
    FOREIGN KEY (`alunoId`)
    REFERENCES `lirapaulistana`.`Aluno` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aula_professor`
    FOREIGN KEY (`professorId`)
    REFERENCES `lirapaulistana`.`Professor` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`EventoMusical`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`EventoMusical` (
  `eventoId` INT NOT NULL,
  `nome` VARCHAR(140) NOT NULL,
  PRIMARY KEY (`eventoId`),
  CONSTRAINT `fk_eventoMusical_evento`
    FOREIGN KEY (`eventoId`)
    REFERENCES `lirapaulistana`.`Evento` (`eventoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lirapaulistana`.`Operador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lirapaulistana`.`Operador` (
  `usuarioId` INT NOT NULL,
  INDEX `fk_operador_usuario_idx` (`usuarioId` ASC),
  PRIMARY KEY (`usuarioId`),
  CONSTRAINT `fk_operador_usuario`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `lirapaulistana`.`Usuario` (`usuarioId`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
