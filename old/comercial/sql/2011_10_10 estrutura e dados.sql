--
-- Database: `acsnetbr_comercial`
-- Estrutura 
--
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `url_form_terc` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `credito` int(11) NOT NULL,
  `debito` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `pesquisados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `poms` (
  `id_pesquisado` int(11) NOT NULL,
  `str_resultado` longtext NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pesquisado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `real_equipe_pesquisados` (
  `id_real_equipe` int(11) NOT NULL,
  `id_pesquisado` int(11) NOT NULL,
  `str_resultado` longtext CHARACTER SET utf8 NOT NULL,
  `lider` varchar(50) CHARACTER SET utf8 NOT NULL,
  `preenchido` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_real_equipe`,`id_pesquisado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `real_equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8 NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- Dados essenciais
--
INSERT INTO `clientes` (`id`, `nome`, `url_form_terc`, `status`, `credito`, `debito`, `tipo`) VALUES
(1, 'Cliente Principal - ACS', 'algumaCoisa', 'ativo', 70, 13, 'master');

INSERT INTO `usuarios` (`id`, `id_cliente`, `nome`, `usuario`, `senha`, `status`, `tipo`) VALUES
(1, 1, 'Usuário Master', 'master', '81dc9bdb52d04dc20036dbd8313ed055', 'ativo', 'admin'),
(3, 1, 'Antonio Carlos Simões', 'simoes', '139a05a9014980faf13130d2101d8f84', 'ativo', 'master');





--
-- Dados exemplo
--
INSERT INTO `clientes` (`id`, `nome`, `url_form_terc`, `status`, `credito`, `debito`, `tipo`) VALUES
(3, 'Bradesco', 'bradesco', 'ativo', 3, 3, '');

INSERT INTO `usuarios` (`id`, `id_cliente`, `nome`, `usuario`, `senha`, `status`, `tipo`) VALUES
(4, 3, 'Alguem do Bradesco', 'alguem_do_bradesco@email', '81dc9bdb52d04dc20036dbd8313ed055', 'ativo', 'master');

INSERT INTO `pesquisados` (`id`, `id_cliente`, `nome`, `email`, `cpf`, `data_nascimento`, `sexo`) VALUES
(1, 1, 'Felipe Jonatas', 'felipe@domdiagnosticos.com.br', '38664564841', '1989-03-14', 'masculino'),
(2, 1, 'Denise Marianno ', 'denise@domdiagnosticos.com.br', '02298179808', '1963-09-09', 'feminino'),
(3, 1, 'Fávio Micheletti', 'flavio@email.com.br', '4444-6666', '1977-09-27', 'masculino'),
(4, 1, 'Neusa Miguel', 'nao informado', 'naoinformadonao', '0101-01-01', 'feminino'),
(5, 3, 'João do bradesco', 'joao@bradesco.com.br', '123.456.789', '0000-00-00', 'masculino'),
(6, 3, 'Mara do Bradesco', 'maria@bradesco.com.br', '123.456.789', '0000-00-00', 'feminino'),
(7, 3, 'Osvaldo', 'osvaldinho', '12345678', '0000-00-00', 'masculino');

INSERT INTO `poms` (`id_pesquisado`, `str_resultado`, `status`) VALUES
(1, '1_5, 2_5, 3_2, 4_3, 5_2, 6_5, 7_5, 9_2, 10_2, 11_2, 12_2, 13_4, 14_1, 15_2, 16_2, 17_3, 18_2, 19_5, 20_4, 21_1, 22_3, 23_2, 24_5, 25_5, 26_4, 27_4, 28_1, 29_4, 30_3, 31_1, 32_2, 33_4, 34_4, 35_5, 36_1, 37_2, 38_5, 39_2, 40_3, 41_4, 42_3, 43_5, 46_1, 47_1, 48_5, 49_4, 50_3, 51_5, 52_1, 53_3, 55_5, 56_4, 57_3, 58_2, 59_5, 60_4, 61_1, 62_5, 63_4, 64_4, 65_4', 'processado'),
(2, '1_4, 2_2, 3_3, 4_2, 5_2, 6_4, 7_5, 8_2, 9_1, 10_4, 11_2, 12_1, 13_4, 14_2, 15_5, 16_1, 17_1, 18_2, 19_5, 20_2, 21_1, 22_1, 23_1, 24_1, 25_4, 26_1, 27_2, 28_1, 29_1, 30_5, 31_2, 32_1, 33_1, 34_2, 35_1, 36_1, 37_1, 38_5, 39_1, 40_2, 41_3, 42_2, 43_5, 44_1, 45_2, 46_1, 47_1, 48_1, 49_1, 50_1, 51_4, 52_1, 53_2, 54_5, 55_5, 56_5, 57_1, 58_1, 59_1, 60_1, 61_1, 62_1, 63_4, 64_1, 65_1', 'processado'),
(3, '1_5, 2_1, 3_1, 4_1, 5_1, 6_5, 7_5, 8_1, 9_1, 10_1, 11_1, 12_1, 13_3, 14_1, 15_5, 16_1, 17_1, 18_1, 19_5, 20_1, 21_1, 22_5, 23_1, 24_1, 25_4, 26_1, 27_1, 28_1, 29_1, 30_3, 31_1, 32_1, 33_1, 34_1, 35_1, 36_1, 37_1, 38_4, 39_1, 40_1, 41_1, 42_1, 43_4, 44_1, 45_1, 46_1, 47_1, 48_1, 49_1, 50_1, 51_4, 52_1, 53_1, 54_5, 55_5, 56_5, 57_5, 58_1, 59_1, 60_1, 61_1, 62_1, 63_1, 64_1, 65_1', 'processado'),
(4, '1_4, 2_5, 3_5, 4_1, 5_1, 6_1, 7_4, 8_1, 9_2, 10_5, 11_1, 12_1, 13_5, 14_1, 15_5, 16_4, 17_1, 18_1, 19_5, 20_1, 21_1, 22_1, 23_1, 24_1, 25_4, 26_4, 27_4, 28_2, 29_1, 30_4, 31_4, 32_1, 33_1, 34_3, 35_4, 36_1, 37_1, 38_5, 39_1, 40_1, 41_5, 42_4, 43_5, 44_1, 45_1, 46_1, 47_4, 48_1, 49_1, 50_1, 51_5, 52_1, 53_2, 54_5, 55_5, 56_5, 57_4, 58_1, 59_1, 60_1, 61_1, 62_1, 63_5, 64_1, 65_1', 'processado'),
(5, '1_2, 2_2, 3_2, 4_2, 5_2, 6_2, 7_2, 8_2, 9_2, 10_2, 11_2, 12_2, 13_2, 14_2, 15_2, 16_2, 17_2, 18_2, 19_2, 20_2, 21_2, 22_2, 23_2, 24_2, 25_2, 26_2, 27_2, 28_2, 29_2, 30_2, 31_2, 32_2, 33_2, 34_2, 35_2, 36_2, 37_2, 38_2, 39_2, 40_2, 41_2, 42_2, 43_2, 44_2, 45_2, 46_2, 47_2, 48_2, 49_2, 50_2, 51_2, 52_2, 53_2, 54_2, 55_2, 56_2, 57_2, 58_2, 59_2, 60_2, 61_2, 62_2, 63_2, 64_2, 65_2', 'processado'),
(6, '1_1, 2_1, 3_1, 4_1, 5_1, 6_1, 7_1, 8_1, 9_1, 10_1, 11_1, 12_1, 13_1, 14_1, 15_1, 16_1, 17_1, 18_1, 19_1, 20_1, 21_1, 22_1, 23_1, 24_1, 25_1, 26_1, 27_1, 28_1, 29_1, 30_1, 31_1, 32_1, 33_1, 34_1, 35_1, 36_1, 37_1, 38_1, 39_1, 40_1, 41_1, 42_1, 43_1, 44_1, 45_1, 46_1, 47_1, 48_1, 49_1, 50_1, 51_1, 52_1, 53_1, 54_1, 55_1, 56_1, 57_1, 58_1, 59_1, 60_1, 61_1, 62_1, 63_1, 64_1, 65_1', 'processado'),
(7, '1_1, 2_1, 3_1, 4_1, 5_1, 6_1, 7_1, 8_1, 9_1, 10_1, 11_1, 12_1, 13_1, 14_1, 15_1, 16_1, 17_1, 18_1, 19_1, 20_1, 21_1, 22_1, 23_1, 24_1, 25_1, 26_1, 27_1, 28_1, 29_1, 30_1, 31_1, 32_1, 33_1, 34_1, 35_1, 36_1, 37_1, 38_1, 39_1, 40_1, 41_1, 42_1, 43_1, 44_1, 45_1, 46_1, 47_1, 48_1, 49_1, 50_1, 51_1, 52_1, 53_1, 54_1, 55_1, 56_1, 57_1, 58_1, 59_1, 60_1, 61_1, 62_1, 63_1, 64_1, 65_1', 'processado');


INSERT INTO `real_equipe` (`id`, `id_cliente`, `nome`, `status`) VALUES
(1, 3, 'Time do bradesco I', 'nao_preenchido'),
(2, 3, 'Time do bradesco II', 'nao_preenchido'),
(3, 1, 'Dom', 'nao_preenchido');

INSERT INTO `real_equipe_pesquisados` (`id_real_equipe`, `id_pesquisado`, `str_resultado`, `lider`, `preenchido`) VALUES
(1, 5, '', 'sim', 'nao'),
(1, 7, '', 'nao', 'nao'),
(2, 5, '', 'nao', 'nao'),
(2, 6, '', 'sim', 'nao'),
(2, 7, '', 'nao', 'nao'),
(3, 1, '', 'nao', 'nao'),
(3, 2, '', 'nao', 'nao'),
(3, 3, '', 'nao', 'nao'),
(3, 4, '', 'sim', 'nao');
