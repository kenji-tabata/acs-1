--
-- Tables
--
CREATE TABLE IF NOT EXISTS `poms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `formulario` text NOT NULL,
  `preenchido_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `profissionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `genero` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Keys
--
ALTER TABLE `poms`
  ADD CONSTRAINT `poms_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `profissionais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Views
--
-- drop view viewPoms;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW viewPoms AS
select pr.id, pr.nome, pr.email, pr.cpf, pr.genero,
date_format(poms.preenchido_em, '%d/%m/%Y') as `preench`,
formulario as adjetivos
from (
  profissionais AS pr
  inner join poms on pr.id = poms.id_prof
);

--
-- Dados de exemplo
--
INSERT INTO `profissionais` (`id`, `nome`, `email`, `cpf`, `genero`) VALUES
(1, 'Fulano', 'fulano@email.com', '111.222.333-44', 'm');
INSERT INTO `poms` (`id`, `id_prof`, `formulario`, `preenchido_em`) VALUES
(1, 1, '1-1, 2-1, 3-1, 4-1, 5-1, 6-1, 7-1, 8-1, 9-1, 10-1, 11-1, 12-1, 13-1, 14-1, 15-1, 16-1, 17-1, 18-1, 19-1, 20-1, 21-1, 22-1, 23-1, 24-1, 25-1, 26-1, 27-1, 28-1, 29-1, 30-1, 31-1, 32-1, 33-1, 34-1, 35-1, 36-1, 37-1, 38-1, 39-1, 40-1, 41-1, 42-1, 43-1, 44-1, 45-1, 46-1, 47-1, 48-1, 49-1, 50-1, 51-1, 52-1, 53-1, 54-1, 55-1, 56-1, 57-1, 58-1, 59-1, 60-1, 61-1, 62-1, 63-1, 64-1, 65-1', '2015-11-23 10:58:40');
