--
-- Tables
--
CREATE TABLE IF NOT EXISTS `poms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `formulario` int(11) NOT NULL,
  `preenchido_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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