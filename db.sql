--
-- Tables
--
CREATE TABLE IF NOT EXISTS `acsPoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `formulario` text NOT NULL,
  `preenchido_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `acsProfissionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `genero` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Keys
--
ALTER TABLE `acsPoms`
  ADD CONSTRAINT `poms_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `acsProfissionais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Views
--
-- drop view viewPoms;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW acsViewPoms AS
select pr.id, pr.nome, pr.email, pr.cpf, pr.genero,
date_format(acsPoms.preenchido_em, '%d/%m/%Y') as `preench`,
formulario as adjetivos
from (
  acsProfissionais AS pr
  inner join acsPoms on pr.id = acsPoms.id_prof
);

--
-- Dados de exemplo
--
INSERT INTO `acsProfissionais` (`id`, `nome`, `email`, `cpf`, `genero`) VALUES
(1, 'Fulano', 'fulano@email.com', '111.222.333-44', 'm');
INSERT INTO `acsPoms` (`id`, `id_prof`, `formulario`, `preenchido_em`) VALUES
(1, 1, '1-5, 2-1, 3-1, 4-1, 5-1, 6-5, 7-5, 8-1, 9-1, 10-1, 11-1, 12-1, 13-1, 14-1, 15-5, 16-1, 17-1, 18-1, 19-5, 20-1, 21-1, 22-1, 23-1, 24-1, 25-5, 26-1, 27-1, 28-1, 29-1, 30-5, 31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-5, 39-1, 40-1, 41-1, 42-1, 43-5, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1, 51-1, 52-1, 53-1, 54-1, 55-5, 56-5, 57-1, 58-1, 59-1, 60-5, 61-1, 62-1, 63-5, 64-1, 65-1', '2015-11-23 10:58:40');
