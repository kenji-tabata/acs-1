<?php

class Grupo {

    private $profissionais;

    function add($profissional) {
        $this->profissionais[] = $profissional;
    }

    function get() {
        return $this->profissionais;
    }

}