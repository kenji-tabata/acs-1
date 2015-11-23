ACS
===

Instalação.

    git clone https://github.com/dom-brasil/acs.git
    cd acs/
    composer install

Configuração (banco de dados).

1. Crie a base de dados segundo o script [db.sql](db.sql)
2. Atualize o arquivo [src/includes/DBpdo.php](src/includes/DBpdo.php)

Testes.

    cd acs/
    phpunit src/testes/


No browser.

    http://localhost/acs/src/

Requerimentos.

- PHP 5.6