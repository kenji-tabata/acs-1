CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(200) NOT NULL,
  `url_form_terc` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `credito` int(11) NOT NULL,
  `debito` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `url_form_terc`, `status`, `credito`, `debito`, `tipo`) VALUES
(1, 'Cliente Principal - ACS', 'simoes', 'ativo', 70, 34, 'master'),
(4, 'Clube Atlético', 'atletico', 'ativo', 25, 0, ''),
(5, 'E.C. Pinheiros ', 'pinheiros', 'ativo', 1000, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pesquisados`
--

CREATE TABLE IF NOT EXISTS `pesquisados` (
  `id` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pesquisados`
--

INSERT INTO `pesquisados` (`id`, `id_cliente`, `nome`, `email`, `cpf`, `data_nascimento`, `sexo`) VALUES
(1, 1, 'Felipe Jonatas laudo 5', 'felipe@domdiagnosticos.com.br', '386.645.648-41', '1989-03-14', 'masculino'),
(2, 1, 'Denise Marianno laudo 5', 'denise@domdiagnosticos.com.br', '022.981.798-08', '1963-09-09', 'feminino'),
(3, 1, 'Fávio laudo 1', 'flavio@email.com.br', '153.169.848-47', '1977-09-27', 'masculino'),
(4, 1, 'Neusa Miguel laudo 5', 'neusa@email.com', '153.169.848-47', '0101-01-01', 'feminino'),
(5, 1, 'Cida Prado laudo 7', 'cidaprado@terra.com.br', '028.678.208-05', '2058-06-02', 'feminino'),
(6, 1, 'laudo 2', 'laudo2@email.com', '153.168.484-46', '1977-09-27', 'masculino'),
(7, 1, 'teste', 'teste@email.com', '153.169.848-46', '2014-02-12', 'masculino');

-- --------------------------------------------------------

--
-- Table structure for table `poms`
--

CREATE TABLE IF NOT EXISTS `poms` (
  `id_pesquisado` int(11) NOT NULL,
  `str_resultado` longtext NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_pesquisado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poms`
--

INSERT INTO `poms` (`id_pesquisado`, `str_resultado`, `status`) VALUES
(1, '1_5, 2_5, 3_2, 4_3, 5_2, 6_5, 7_5, 9_2, 10_2, 11_2, 12_2, 13_4, 14_1, 15_2, 16_2, 17_3, 18_2, 19_5, 20_4, 21_1, 22_3, 23_2, 24_5, 25_5, 26_4, 27_4, 28_1, 29_4, 30_3, 31_1, 32_2, 33_4, 34_4, 35_5, 36_1, 37_2, 38_5, 39_2, 40_3, 41_4, 42_3, 43_5, 46_1, 47_1, 48_5, 49_4, 50_3, 51_5, 52_1, 53_3, 55_5, 56_4, 57_3, 58_2, 59_5, 60_4, 61_1, 62_5, 63_4, 64_4, 65_4', 'processado'),
(2, '1_4, 2_2, 3_3, 4_2, 5_2, 6_4, 7_5, 8_2, 9_1, 10_4, 11_2, 12_1, 13_4, 14_2, 15_5, 16_1, 17_1, 18_2, 19_5, 20_2, 21_1, 22_1, 23_1, 24_1, 25_4, 26_1, 27_2, 28_1, 29_1, 30_5, 31_2, 32_1, 33_1, 34_2, 35_1, 36_1, 37_1, 38_5, 39_1, 40_2, 41_3, 42_2, 43_5, 44_1, 45_2, 46_1, 47_1, 48_1, 49_1, 50_1, 51_4, 52_1, 53_2, 54_5, 55_5, 56_5, 57_1, 58_1, 59_1, 60_1, 61_1, 62_1, 63_4, 64_1, 65_1', 'processado'),
(3, '1_5, 2_1, 3_1, 4_1, 5_1, 6_5, 7_5, 8_1, 9_1, 10_1, 11_1, 12_1, 13_3, 14_1, 15_5, 16_1, 17_1, 18_1, 19_5, 20_1, 21_1, 22_5, 23_1, 24_1, 25_4, 26_1, 27_1, 28_1, 29_1, 30_3, 31_1, 32_1, 33_1, 34_1, 35_1, 36_1, 37_1, 38_4, 39_1, 40_1, 41_1, 42_1, 43_4, 44_1, 45_1, 46_1, 47_1, 48_1, 49_1, 50_1, 51_4, 52_1, 53_1, 54_5, 55_5, 56_5, 57_5, 58_1, 59_1, 60_1, 61_1, 62_1, 63_1, 64_1, 65_1', 'processado'),
(4, '1_4, 2_5, 3_5, 4_1, 5_1, 6_1, 7_4, 8_1, 9_2, 10_5, 11_1, 12_1, 13_5, 14_1, 15_5, 16_4, 17_1, 18_1, 19_5, 20_1, 21_1, 22_1, 23_1, 24_1, 25_4, 26_4, 27_4, 28_2, 29_1, 30_4, 31_4, 32_1, 33_1, 34_3, 35_4, 36_1, 37_1, 38_5, 39_1, 40_1, 41_5, 42_4, 43_5, 44_1, 45_1, 46_1, 47_4, 48_1, 49_1, 50_1, 51_5, 52_1, 53_2, 54_5, 55_5, 56_5, 57_4, 58_1, 59_1, 60_1, 61_1, 62_1, 63_5, 64_1, 65_1', 'processado'),
(5, '1_3, 2_5, 3_4, 4_4, 5_5, 6_1, 7_1, 8_1, 9_1, 10_4, 11_1, 12_3, 13_2, 14_4, 15_3, 16_4, 17_2, 18_4, 19_2, 20_5, 21_3, 22_1, 23_2, 24_2, 25_3, 26_4, 27_4, 28_3, 29_2, 30_4, 31_4, 32_2, 33_3, 34_4, 35_4, 36_1, 37_3, 38_3, 39_3, 40_2, 41_5, 42_3, 43_4, 44_4, 45_4, 46_1, 47_3, 48_3, 49_3, 50_1, 51_3, 52_4, 53_4, 54_4, 55_3, 56_3, 57_2, 58_1, 59_4, 60_1, 61_1, 62_1, 63_4, 64_1, 65_3', 'processado'),
(6, '1_1, 2_1, 3_1, 4_1, 5_4, 6_1, 7_3, 8_1, 9_1, 10_2, 11_2, 12_5, 13_1, 14_1, 15_5, 16_4, 17_2, 18_2, 19_5, 20_1, 21_1, 22_1, 23_1, 24_1, 25_2, 26_4, 27_4, 28_2, 29_4, 30_2, 31_1, 32_4, 33_1, 34_1, 35_4, 36_2, 37_1, 38_2, 39_4, 40_3, 41_4, 42_4, 43_5, 44_3, 45_4, 46_4, 47_3, 48_1, 49_3, 50_1, 51_3, 52_3, 53_1, 54_4, 55_4, 56_4, 57_4, 58_1, 59_2, 60_1, 61_4, 62_1, 63_5, 64_1, 65_4', 'processado');

-- --------------------------------------------------------

--
-- Table structure for table `real_equipe`
--

CREATE TABLE IF NOT EXISTS `real_equipe` (
  `id` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `real_equipe`
--

INSERT INTO `real_equipe` (`id`, `id_cliente`, `nome`, `status`) VALUES
(3, 1, 'Dom', 'processado'),
(4, 1, 'qq', 'nao_preenchido');

-- --------------------------------------------------------

--
-- Table structure for table `real_equipe_pesquisados`
--

CREATE TABLE IF NOT EXISTS `real_equipe_pesquisados` (
  `id_real_equipe` int(11) NOT NULL,
  `id_pesquisado` int(11) NOT NULL,
  `str_resultado` longtext NOT NULL,
  `lider` varchar(50) NOT NULL,
  `preenchido` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_real_equipe`,`id_pesquisado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `real_equipe_pesquisados`
--

INSERT INTO `real_equipe_pesquisados` (`id_real_equipe`, `id_pesquisado`, `str_resultado`, `lider`, `preenchido`) VALUES
(3, 2, '1_2, 11_3, 21_4, 31_5, 36_1, 41_2, 2_3, 12_4, 22_5, 32_5, 37_2, 42_3, 3_4, 13_5, 23_1, 33_2, 38_3, 43_4, 4_5, 14_1, 24_2, 34_3, 39_4, 44_5, 5_1, 15_2, 25_3, 35_2, 40_5, 45_1, 6_4, 16_3, 26_2, 46_5, 7_1, 17_2, 27_3, 47_2, 8_5, 18_1, 28_2, 48_3, 9_2, 19_5, 29_1, 49_2, 10_3, 20_4, 30_5, 50_1', 'nao', 'sim'),
(3, 3, '1_3, 11_3, 21_4, 31_3, 36_2, 41_3, 2_4, 12_3, 22_2, 32_3, 37_4, 42_3, 3_2, 13_3, 23_4, 33_2, 38_3, 43_4, 4_3, 14_2, 24_3, 34_4, 39_3, 44_2, 5_3, 15_4, 25_3, 35_4, 40_3, 45_4, 6_3, 16_2, 26_3, 46_4, 7_3, 17_2, 27_3, 47_2, 8_3, 18_2, 28_3, 48_4, 9_3, 19_2, 29_3, 49_4, 10_3, 20_2, 30_3, 50_4', 'nao', 'sim'),
(3, 4, '1_4, 11_3, 21_2, 31_1, 36_2, 41_3, 2_4, 12_4, 22_5, 32_1, 37_5, 42_3, 3_2, 13_1, 23_2, 33_2, 38_3, 43_4, 4_5, 14_5, 24_3, 34_1, 39_1, 44_1, 5_3, 15_3, 25_3, 35_3, 40_3, 45_3, 6_3, 16_5, 26_4, 46_5, 7_1, 17_5, 27_1, 47_1, 8_1, 18_5, 28_1, 48_3, 9_3, 19_3, 29_4, 49_2, 10_2, 20_2, 30_4, 50_2', 'sim', 'sim'),
(4, 1, '', 'nao', 'nao'),
(4, 2, '', 'nao', 'nao'),
(4, 3, '', 'nao', 'nao'),
(4, 4, '', 'nao', 'nao'),
(4, 5, '', 'nao', 'nao');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL auto_increment,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) default NULL,
  `status` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_cliente`, `nome`, `usuario`, `senha`, `status`, `tipo`) VALUES
(1, 1, 'Usuário Master', 'master', 'f4775f885a7d081804a404fab50aa435', 'ativo', 'master'),
(3, 1, 'Antonio Carlos Simões', 'simoes', '81dc9bdb52d04dc20036dbd8313ed055', 'ativo', 'master');

         