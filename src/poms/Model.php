<?php

class PomsModel {

    #
    # Lista de profissionais que preencheram o poms
    #
    function ret_lista_profissionais($sql='') {
        $sql  = "SELECT * FROM acsViewPoms $sql";
        $stmt = DBpdo::conectar()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    #
    #
    #
    function ret_criterios($filtro) {
        $criterios = '';
        if (isset($filtro->nome)) {
            $criterios .= 'nome LIKE "%' . $filtro->nome .'%"';
        }
        if (isset($filtro->genero)) {
            $criterios .= $this->ret_criterios_aux($criterios);
            $criterios .= 'genero = "' . $filtro->genero .'"';
        }
        if (isset($filtro->preench_inicio) AND isset($filtro->preench_fim)) {
            $criterios .= $this->ret_criterios_aux($criterios);
            $criterios .= 'preench BETWEEN "' . $filtro->preench_inicio .'" AND "' . $filtro->preench_fim .'"';
        }
        if ($criterios) {
            return "WHERE " . $criterios;
        } else {
            return "";
        }
    }

    #
    # Auxila a função 'ret_criterios' a definir o operador 'AND'
    #
    function ret_criterios_aux($frag) {
        if($frag) {
            return " AND ";
        } else {
            return "";
        }
    }

    #
    # Read um único profissional
    #
    function read_profissional($id=null) {
        if (!$id) return null;

        $sql  = "SELECT * FROM acsViewPoms where id = $id";
        $stmt = DBpdo::conectar()->query($sql);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    #
    # Deletar profissional e poms
    #
    function deletar_profissional($id) {
        $query = "DELETE from acsProfissionais WHERE id = :id";
        $pdo = DBpdo::conectar();
        $sth = $pdo->prepare($query);
        $sth->bindParam(':id', $id);
        $sth->execute();

        # como a tabela 'poms' possui chave estrangeira o delete acorre no db

        return $id;
    }

    #
    # Insert profissional  e poms
    #
    function insert_profissional($profissional) {
        date_default_timezone_set ("America/Sao_Paulo");
        $query = "INSERT INTO acsProfissionais (nome, email, cpf, genero) VALUES (:nome, :email, :cpf, :genero)";
        $pdo = DBpdo::conectar();
        $sth = $pdo->prepare($query);
        $sth->bindParam(':nome',   $profissional->nome);
        $sth->bindParam(':email',  $profissional->email);
        $sth->bindParam(':cpf',    $profissional->cpf);
        $sth->bindParam(':genero', $profissional->genero);
        $sth->execute();

        $profissional->id = $pdo->lastInsertId();
        
        $preench = parseDate($profissional->preench);
        if($preench) {
            $profissional->preench = $preench;
        } else {
            $profissional->preench = date("Y-m-d H:i:s");
        }

        $query = "INSERT INTO acsPoms (id_prof, formulario, preenchido_em) VALUES (:id_prof, :formulario, :preenchido_em)";
        $pdo = DBpdo::conectar();
        $sth = $pdo->prepare($query);
        $sth->bindParam(':id_prof',       $profissional->id);
        $sth->bindParam(':formulario',    $profissional->adjetivos);
        $sth->bindParam(':preenchido_em', $profissional->preench);
        $sth->execute();

        $profissional->poms_id = $pdo->lastInsertId();

        return $profissional;
    }

    #
    # Update profissional  e poms
    #
    function update_profissional($profissional) {
        date_default_timezone_set ("America/Sao_Paulo");
        $query = "UPDATE acsProfissionais  SET nome=:nome, email=:email, cpf=:cpf, genero=:genero WHERE id=:id";
        $pdo = DBpdo::conectar();
        $sth = $pdo->prepare($query);
        $sth->bindParam(':id',     $profissional->id);
        $sth->bindParam(':nome',   $profissional->nome);
        $sth->bindParam(':email',  $profissional->email);
        $sth->bindParam(':cpf',    $profissional->cpf);
        $sth->bindParam(':genero', $profissional->genero);
        $sth->execute();

        $profissional->preench = date("Y-m-d H:i:s");

        $query = "UPDATE acsPoms SET formulario=:formulario, preenchido_em=:preenchido_em WHERE id_prof = :id_prof";
        $pdo = DBpdo::conectar();
        $sth = $pdo->prepare($query);
        $sth->bindParam(':id_prof',       $profissional->id);
        $sth->bindParam(':formulario',    $profissional->adjetivos);
        $sth->bindParam(':preenchido_em', $profissional->preench);
        $sth->execute();

        return $profissional;
    }

}