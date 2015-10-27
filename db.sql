-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 27/10/2015 às 19:18:42
-- Versão do Servidor: 5.5.44
-- Versão do PHP: 5.6.14-1~dotdeb+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `acs_01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `poms`
--

CREATE TABLE IF NOT EXISTS `poms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `formulario` int(11) NOT NULL,
  `preenchido_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissionais`
--

CREATE TABLE IF NOT EXISTS `profissionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `genero` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `poms`
--
ALTER TABLE `poms`
  ADD CONSTRAINT `poms_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `profissionais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;