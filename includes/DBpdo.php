<?php

/**
 * Classe responsável pela conexão com o banco de dados
 */
abstract class DBpdo {

    private static $pdo;

    static function conectar($base = "acs_01") {
        $host = "localhost";
        $user = "root";
        $pass = "1234";

        # if não há conexão...
        if (empty(self::$pdo)) {
            $dsn = "mysql:dbname=$base;host=$host";
            self::$pdo = new PDO($dsn, $user, $pass); # conecta
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); # apresentar erros
            self::$pdo->exec("set names utf8"); # Codificar a base de dados para UTF8 por Padrão é ISO
        }

        return self::$pdo;
    }

    static function lastInsertId() {
        return self::$pdo->lastInsertId();
    }

}

// Implementação
//$conexao = DBpdo::conectar("acs_01");
//var_dump($conexao);die();
//unset($conexao);
?>
